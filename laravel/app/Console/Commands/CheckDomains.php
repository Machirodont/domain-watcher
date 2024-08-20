<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Services\CheckDomains\CheckDomainService;
use App\Services\CheckDomains\DomainChecker;
use App\Services\CheckDomains\DomainCheckLogRepository;
use App\Services\CheckDomains\DomainRepository;
use App\Services\SlackConnector\SlackConnector;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckDomains extends Command
{
    protected $signature = 'app:check-domains';

    protected $description = 'Command description';

    private const MESSAGE_TEMPLATE = "Домен %s в группе *%s* недоступен с _%s_\r\n Используйте домен %s";
    private const MESSAGE_TEMPLATE_NO_DOMAINS = "Домен %s в группе *%s* недоступен с _%s_\r\n Доступных доменов в группе больше нет.";

    public function handle(
        DomainChecker $domainChecker,
        SlackConnector $slackConnector,
        DomainRepository $domainRepository,
        CheckDomainService $checkDomainService,
        DomainCheckLogRepository $domainCheckLogRepository,
    ) {
        $domains = $domainRepository->getDomainsThatTimeToCheck();

        foreach ($domains as $domain) {
            $domainCheckLogRepository->getCheckLogSummary($domain->id, 10);

            $domain->last_check_at = Carbon::now();
            $domain->save();

            $log = $domainChecker->check($domain);

            if($checkDomainService->needTurnOnline($domain, $log)){
                $domainRepository->goOnline($domain);
            }

            if($checkDomainService->needTurnOffline($domain, $log)){
                $domainRepository->goOffline($domain);
                $replacementDomain = $domainRepository->getReplacementForDomain($domain);
                $slackConnector->send(
                    $this->getMessage($domain, $replacementDomain)
                );
            }
        }
    }

    private function getMessage(Domain $offlineDomain, ?Domain $replacementDomain): string
    {
        return is_null($replacementDomain)
            ? vsprintf(self::MESSAGE_TEMPLATE_NO_DOMAINS, [
                $offlineDomain->url,
                $offlineDomain->group->name,
                $offlineDomain->offline_since->format(Carbon::DEFAULT_TO_STRING_FORMAT),
            ])
            : vsprintf(self::MESSAGE_TEMPLATE, [
                $offlineDomain->url,
                $offlineDomain->group->name,
                $offlineDomain->offline_since->format(Carbon::DEFAULT_TO_STRING_FORMAT),
                $replacementDomain->url,
            ]);
    }
}
