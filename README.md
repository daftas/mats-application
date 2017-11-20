# MATS Aplikacijos prototipas

Mobile Application Testing Solution 
[MATS yra pasiekiama naudotojant šią nuorodą](https://github.com/daftas/mats-application/).


# MATS veikimo principas

Aplikacija veikia leidžiant MatsApp.php failą, kuris rodo šį failą naršyklėje .html formatu, naudojant vidinį serverį (localhost) ir .htaccess veikimo principą. Šis failas parodo galinį rezultatą vartotojui ir atlieka paskutiniuosius skaičiavimus.

### [Pirmoji prototipo funkcija](https://github.com/daftas/mats-application/blob/master/helloworld.php)

### Papildomi dokumentai, kuriuose yra parašytas prototipo programinis kodas:

 [**MatsTests.php**](https://github.com/daftas/mats-application/blob/master/MatsTests.php)

Programinis kodas, kuriame yra parašyti visi atliekmi automatiniai testai. Jie padeda suskaičiuoti projekto kaštus.

[**MatsElements.php**](https://github.com/daftas/mats-application/blob/master/MatsElements.php)

Programinis kodas, kuriame yra sudėti visi prototipo automatinių testų elementai ir objektinės klasės. Šis failas yra naudojamas automatinių testų funkcijoms ir rezultatams pagrįsti. 


### Prototipe naudojamos bibliotekos ir kiti gamintojai (Libraries and Vendors)

[**composer.lock**](https://github.com/daftas/mats-application/blob/master/composer.lock)

Composer tipo failas, kuriame yra sugeneruotos visos papildomos aplikacijos ir jų būsena (aplikacijų versijavimo _hash_), palaikančios protipo veikimą ir palengvinančios jo darbą. 
