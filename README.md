
## 安装


- 路由配置

~~~
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
~~~

- 访问

API 访问地址：/apidoc


## 依赖
- [laravel 10](https://laravel.com/docs/10.x)
- [laravel-route-attributes](https://github.com/spatie/laravel-route-attributes)
- [apidoc](https://docs.apidoc.icu/use/)
- [locales](https://laravel-lang.com/usage-add-locales.html)

##  Octane

~~~
location / {
    try_files $uri $uri/ @octane;
} 

location @octane {
    set $suffix "";

    if ($uri = /index.php) {
        set $suffix ?$query_string;
    }

    proxy_http_version 1.1;
    proxy_set_header Host $http_host;
    proxy_set_header Scheme $scheme;
    proxy_set_header SERVER_PORT $server_port;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection $connection_upgrade;

    proxy_pass http://127.0.0.1:8000$suffix;
}
~~~