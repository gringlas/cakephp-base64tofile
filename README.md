# Base64ToFile plugin for CakePHP

## About

This plugin will convert a base64 encoded file string into a "classic" fileupload $_FILES, which can then be passed to other fileuploads.

## Installation

Das Plugin wird aus unserem bitbucket geladen und nicht mit composer (da wir kein lokales packagist haben).
Die composer.json des gewünschten Projekts bitte folgendermaßen erweitern: (Achtung BITBUCKETNAME durch eigenen Accountnamen erstzen.)

```
"require" : {
    "gringlas/cakephp-base64tofile" : "dev-master"
},
"config" : {
    "secure-http" : false
},
"repositories" : [
    {
        "type" : "vcs",
        "url" : "http://BITBUCKETNAME@jira.phihochzwei.com:7990/scm/cpp/base64tofile.git"
    }
]
```

Danach wie gewohnt 

```
composer update
```
