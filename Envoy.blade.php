@servers(['prod' => 'calypso'])

@setup
    $slack_webhook = file_get_contents('.slack_webhook')
@endsetup

@task('deploy', ['on' => $server])
    cd docker/pb

    git pull origin master

    @if ($docker)
        docker-compose build

        docker-compose up -d
    @endif

    cd app

    composer install

    npm run prod

    docker exec pb_php_1 php artisan migrate --force

    docker exec pb_php_1 php artisan cache:clear
@endtask

@after
    @slack($slack_webhook, '#envoy')
@endafter