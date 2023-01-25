# UoD Agile Course Project - AC31007-2022
## Website Link
### [https://agile-team1.azurewebsites.net](https://agile-team1.azurewebsites.net)

---
## Description
A web application connected to a backend for the The Little Green Larder shop.

---

## Connecting through MySQL Workbench
- Use the credentials provided in [`./config/database.php`](https://github.com/KamilKrauze/agile_project/tree/main/config)
- In the SSL tab, link the ssl file that is in the repository at [`./ssl/certs/DigiCertGlobalRootCA.crt.pem`](https://github.com/KamilKrauze/agile_project/tree/ssl/certs/) under the SSL CA filepath.
- You will be required to send over your Public IP (probably in teams chat or to me directly) so it could be added to the firewall otherwise you may not be able to connect to it through or MySQL Workbench nor PHP (it sucks but that's how Azure forces me to do it).
- Please use the `ldl` schema as that is where the tables exist.

## Use how to use the db linking file
- By default there should be a connection to the DB as it has been initilialized in the `header.php` file.
- The connection uses PDO so refer to PHP PDO based tutorials on sites such as [TutorialRepublic](https://www.tutorialrepublic.com/php-tutorial/) if unsure how to use this interface.

## Authors
- Andrii Sultanov
- Daryna Hnatenko
- Dimitar Valkov
- Kamil Krauze
- Maria Mara Gatillo
- Vera Borvinski
- Victor Iyida

---
