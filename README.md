
## Deployment

To deploy this project run

#### Clone the project

```bash
  git clone https://github.com/majid-gholamheidari/webtab_project
```
#### Go to the project directory

```bash
  cd webtab_project
```

#### Update .env file
edit the following items according to your needs
 
- MAIL_MAILER=smtp
- MAIL_HOST=sandbox.smtp.mailtrap.io
- MAIL_PORT=2525
- MAIL_USERNAME=2297b4229f6da3
- MAIL_PASSWORD=4eb143d3391a4d
- DB_DATABASE=webtab_project
- DB_USERNAME=root
- DB_PASSWORD=

#### Assets files
to display the dashboard panel correctly, you need to extract files **storage.zip** and **public.zip** 

#### Install dependencies
```bash
  composer install
```

#### Storage links

```bash
  php artisan storage:link
```

#### Tables and fake data
```bash
  php artisan migrate --seed
```
**Or**
```bash
  php artisan migrate
```
```bash
  php artisan db:seed
```
#### And at the end, start the server
```bash
  php artisan serve
```
## Usage

Username and password for admin login

email/username : `admin@webtab.com`

password: `admin@webtab.com`

