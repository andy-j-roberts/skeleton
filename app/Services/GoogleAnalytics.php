<?php

namespace App\Services;

use Google_Client;
use Google_Service_AnalyticsReporting;
use Google_Service_AnalyticsReporting_GetReportsRequest;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_ReportRequest;
use GuzzleHttp\Client;

class GoogleAnalytics
{
    const BASE_URI = 'http://www.google-analytics.com';
    const VERSION = 1;
    const SCOPE = 'https://www.googleapis.com/auth/analytics.readonly';
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'timeout'  => 2.0,
        ]);

        $this->service = $this->getAnalyticsService();
    }

    public function forViewId($view_id)
    {
        $this->view_id = (string) $view_id;

        return $this;
    }

    protected function getAnalyticsService()
    {
        $config = app_path('../Events-f464520c896d.json');
        $client = new Google_Client();
        $client->setApplicationName(setting('app.name'));
        $client->setAuthConfig($config);
        $client->setScopes([self::SCOPE]);

        return new Google_Service_AnalyticsReporting($client);
    }

    public function getReport()
    {
        $sessions = new Google_Service_AnalyticsReporting_Metric();
        $sessions->setExpression("ga:pageviews");
        $sessions->setAlias("views");

        // Create the ReportRequest object.
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($this->view_id);
        $request->setMetrics(array($sessions));

        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests( array( $request) );
        return $this->service->reports->batchGet( $body );
    }

    public function trackPage($title = null)
    {
        return $this->client->post('/collect',[
            'form_params' => [
                'v' => self::VERSION,
                't' => 'pageview',
                'tid' => config('services.google.tid'),
                'cid' => auth()->id(),
                'dh' => request()->getHost(),
                'dp' => request()->path(),
                'dt' => $title = null,
            ]
        ]);
    }

    public function trackEvent($category, $action, $label, $value = null)
    {
        return $this->client->post('/collect',[
            'form_params' => [
                'v' => self::VERSION,
                't' => 'event',
                'tid' => config('services.google.tid'),
                'cid' => auth()->id(),
                'ec' => $category,
                'ea' => $action,
                'el' => $label,
                'ev' => $value,
            ]
        ]);
    }



}