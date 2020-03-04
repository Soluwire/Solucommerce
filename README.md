=======
# Solucommerce

Solucommerce is a free open-source e-commerce platform written in PHP based on Laravel. Solucommerce utilizes composer so please ensure you have it installed.

- Super lightweight e-commerce platform
- Stripe integration for taking payments.
- Uses tailwindcss for responsive and rapid development
- User information encrypted
- Uses Google structured data where possible

## Setup
- run `composer install` inside the directory
#### env
- Go into your project folder and rename `.env.example` to `.env`
- Run `php artisan key:generate` via cmd/bash etc.
- Open the `.env` file and edit it to suit your needs, 

#### DB migration
- Ensure you have added your DB host, name,user and password to the `.env` file 
- Run `php artisan migrate`

#### Login
- Visit your domain : `example.com/admin`
- Login with the defaults : `admin@domain.com` : `admin`
- Once logged in feel free to add products and product variations. 

## Authors
- Jack Bayliss, 2020

## License 
Solucommerce is completely free to use (MIT license)

## Notes
- You can only add products with variants as of 28/02/2020, singular products are not programmed. 
- Currently WIP
>>>>>>> 7840ad8662e3a61eca67b7c08b912a74a6a50b0f
