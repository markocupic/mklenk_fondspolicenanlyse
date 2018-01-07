# Nelmio Security Options unter Contao 4


Damit Requests, die durch die Verwendung eines Iframes unter Contao 4.x nicht geblockt werden, ist es nötig unter 
app/config.yml folgenden Eintrag zu machen. 

```

nelmio_security:
    clickjacking:
        paths:
            '^/.*': ALLOW
            
```            