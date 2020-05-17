<?php

$domains = getenv('MONITOR_DOMAINS');
if ( $domains !== false ) {
  $domains = explode(',', $domains);
} else {
   $domains = ['www.google.com', 'www.amazon.com'];
}

$interval = getenv('MONITOR_INTERVAL');
if ( $interval !== false ) {
  $interval = intval($interval);
} else {
   $interval = 1;
}

foreach( $domains as $domain ) {
	echo ("monitoring ${domain} every ${interval}s\n");
}

while(true) {
  foreach( $domains as $domain ) {
	  $request_time = -microtime(true);

	  $ip = gethostbyname($domain);
	  $request_time += microtime(true);
	  $request_time *= 1000;
	  $request_time = intval(round($request_time));
	  $success = ($ip != $domain) ? 'true': 'false';

	  echo ("{dnsmetrics: {language: \"php\", domain: \"${domain}\", request_time: ${request_time}, success: ${success}}}\n");
  }

  sleep($interval);
}

?>