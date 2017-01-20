@servers(['prod' => 'reach'])

@setup
    $slack_webhook = file_get_contents('.slack_webhook')
@endsetup

@task('deploy', ['on' => $server, 'confirm' => true])
    cd /repositories/pastabin

    git pull origin master

    composer install

    yarn

    npm run prod
@endtask

@after
    @slack($slack_webhook, '#envoy')
@endafter
