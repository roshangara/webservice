# webservice
package for request to another server

Install with composer

```bash
composer require roshangara/webservice
```

# Usage

## send request
```bash
 $webservice = new \Roshangara\Webservice\Webservice();

    $webservice
        ->setMethod('get')
        ->setUrl('https://restcountries.eu/rest/v2/')
        ->setFunction('all')
        ->setParam('fullText', 'true')
        ->send();
        
    \\ get array result
    $webservice->getResult();
```