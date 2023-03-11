
## Cara menjalankan

1. Buat database di mysql dengan nama surplus_challenge
2. Jalankan perintah php artisan migrate
3. Jalankan perintah php artisan db:seed --class=CategorySeeder
4. Jalankan perintah php artisan db:seed --class=ProductSeeder
5. Jalankan perintah php artisan db:seed --class=ImageSeeder
6. Jalankan perintah php artisan serve

## Endpoint yang bisa diakses
- GET       api/category
- POST            api/category
- GET        api/category/{category}
- PUT       api/category/{category}
- DELETE          api/category/{category}

- GET        api/categoryProduct
- POST            api/categoryProduct
- GET        api/categoryProduct/{categoryProduct}

- GET        api/image
- POST            api/image
- GET        api/image/{image}
- PUT       api/image/{image}
- DELETE          api/image/{image}

- GET        api/product
- POST            api/product
- GET        api/product/{product}
- PUT       api/product/{product}
- DELETE          api/product/{product}
- GET        api/productImage
- POST            api/productImage
- GET        api/productImage/{productImage}

