CGraph
======

##ASCII image generator##

##Visit generated output##
https://github.com/moszkva/cgraph/blob/master/generated_sample.txt
  


https://packagist.org/packages/moszkva/cgraph

  
##Installation##

Installation via composer

```json
{
   "require-dev": {
        "moszkva/cgraph": "dev-master"
   }
}
```

##Usage##

  1. Open /bin directory
  2. Configure CGraph.bat file
  3. Run: CGraph.bat [source-file-path] >> [[dest-file-path]]

##Example##
  
Run:

  CGraph https://raw.github.com/moszkva/cgraph/master/tests/Moszkva/CGraph/Test/resource/test.jpg >> image.txt
  

##Unit testing##
  
  - If you have internet connection and openssl extension is loaded and directive allow_url_fopen = On, just simply run phpunit in project root.
  - Otherwise run: phpunit --exclude-group net
  

