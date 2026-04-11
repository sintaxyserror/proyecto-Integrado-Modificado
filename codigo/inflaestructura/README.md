# docker lamp DAW 23-24

Docker with Apache, MySQL, PHPMyAdmin and PHP.

I use docker-compose as an orchestrator. To run these containers:

```
docker-compose up -d
```

Open phpmyadmin at [http://127.0.0.1:8000](http://127.0.0.1:8000)

Open web browser to look at a simple php example at [http://127.0.0.1:8080](http://127.0.0.1:8080)

Clone YourProject on `www/` and then, open web [http://127.0.0.1/YourProject](http://127.0.0.1/YourProject)

### Infrastructure model

![Infrastructure model](./infrastructure_model.png)