# MEOM 3rd party scripts
Make sure that your theme contains:
```
wp_head();
```

And this after you have opened the body tag:
```
wp_body_open();
```

## Filters
You can modify the output with following filters:

- mtps_gtm_id
- mtps_gtm_head_code
- mtps_cookiebot_id
- mtps_cookiebot_code
- mtps_gtm_body_code

## Cookie declaration

Cookie declaration text can be added using shortcode:

```php
[mtps-cookie-declaration]
```
