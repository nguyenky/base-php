# Task 

##### As a developer, I want to run a command which help me to setup database easily with one run.

```
php artisan migrate --seed
```
##### Run command to grab feed urls
```
php artisan feed:urls https://www.feedforall.com/sample.xml,https://www.feedforall.com/sample-feed.xml,https://www.feedforall.com/blog-feed.xml,http://www.rss-specifications.com/blog-feed.xml --log=grab
```
##### I want to see the list of items which were grabbed by running the command line above, via web-based

http://lenguyenky.local/items

##### Run testing 
```
composer test
```