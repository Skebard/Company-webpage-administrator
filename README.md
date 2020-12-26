
[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
<br />
<p align="center">


  <h1 align="center">CMS for a company page</h1>
  <p align='center'>
  <a href='https://tonijorda.com/myProjects/PHP/CMScompany/public/'>View Demo</a>
  </p>
</p>






<!-- ABOUT THE PROJECT -->
## About The Project
A CMS that allows an administrator to create, edit and delete the displayed information in the page.

- Client page
![Screenshot](docImages/mainPage.png)

- Admin page
![Screenshot1](docImages/adminPage.png)

- Add brand
![Screenshot2](docImages/addBrand.png)

### Built With

This project has been built with:
- Laravel
- Bootstrap
- MySQL
- Javascript
- PHP
- Composer


<!-- GETTING STARTED -->
###  Getting Started


1. Clone the repo
   ```sh
   git clone https://github.com/Skebard/Company-webpage-administrator.git
   ```
2. Install composer dependencies
```
composer install
```
3. Install NPM dependencies
```
npm install
```
4. Create a copy of your .env file
```
cp .env.example .env
```
4.Set up your database credentials in the .env file.
```
DB_CONNECTION=mysql
DB_HOST=yourHost
DB_PORT=3306
DB_DATABASE=yourDatabaseName
DB_USERNAME=yourUsername
DB_PASSWORD=yourPassword
```
5. Generate an app encryption key
```
php artisan key:generate
```
6. Create an empty database. Make sure that the name in the .env file corresponds with the created database.
7.Migrate the database
```
php artisan migrate
```

<!-- CONTRIBUTING -->
### Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request










[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: http://www.linkedin.com/in/tjorda
