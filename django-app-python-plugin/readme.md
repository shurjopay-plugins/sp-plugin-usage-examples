![alt text](https://shurjopay.com.bd/dev/images/shurjoPay.png)

## Django example app for sp-plugin-python

# **Installation**
- Create a virtual env for the project
```
python -m venv env
```
- Activate the virtual environment
```
source env/bin/activate
```
> 📝 **NOTE** Make sure to install [sp-plugin-python](https://github.com/shurjopay-plugins)
- `clone` the example app repository

```
git clone https://github.com/shurjopay-plugins/sp-plugin-python
```
- Install project requirements
```
pip install -r requirements.txt
```
- Migrate database
```
python manage.py makemigrations
python manage.py migrate
```


- **Create .env file to save Shurjopay Configurations**

> 📝 **NOTE** For shurjoPay version  2.1 integration all necessary credential will be given t merchant after subscription completed on shurjoPay gateway.

```env
SP_USERNAME=sp_sandbox
SP_PASSWORD=pyyk97hu&6u6
SHURJOPAY_API=https://sandbox.shurjopayment.com/api/
SP_CALLBACK=https://www.sandbox.shurjopayment.com/response
```

- Start the project locally
```
python manage.py runserver
```


### [shurjopay Plugins ](https://github.com/shurjopay-plugins)

## Contact  [shurjopay](https://shurjopay.com.bd/#contacts)
