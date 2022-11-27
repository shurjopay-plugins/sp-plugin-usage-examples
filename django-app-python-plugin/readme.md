![alt text](https://shurjopay.com.bd/dev/images/shurjoPay.png)

# ShurjoPay Online Payment API Integration:

This document has been prepared by Shurjomukhi Limited to enable the online merchants to integrate shurjoPay payment gateway. The information contained in this document is proprietary and confidential to Shurjomukhi Limited, for the product Shurjopay.

# Audience

This document is intended for the technical personnel of merchants and service providers that want to integrate a new online payment gateway using python plugin provided by shurjoPay.

## Django Example Projcet for sp-plugin-python

- **Installation**

> 📝 **NOTE** Install the package inside your Django project environment

Use `pip` to install shuroPay python plugin

>

```
pip install shurjopay-v3

```

Or `clone` the repository

```
git clone https://github.com/shurjopay-plugins/sp-plugin-python

```

Then install the plugin inside your project

```
python setup.py install

```

Developers have to configure .env file in their respective project with five variables, which are SP_USERNAME,SP_PASSWORD, SHURJOPAY_API, SP_CALLBACK,SP_LOG_LOcation and use these to configure the ShurjopayConfigModel to create a instance of Shurjopay python plugin

- **Shurjopay Configurations**

```env
SP_USERNAME=sp_sandbox
SP_PASSWORD=pyyk97hu&6u6
SHURJOPAY_API=https://sandbox.shurjopayment.com/api/
SP_CALLBACK=https://sandbox.shurjopayment.com/response/
SP_LOG_DIR=log/shurjopay/shurjopay.log
```

Load the environment variables using django-environ in `settings.py` file

> 📝 **NOTE** Install `django-environ` if not installed

This Project is intended to set up shurjoPay locally, Hence we are ommeting SP_LOG_DIR from .env
and providing shurjoPay log location in the Project's base directory

```
import environ

# Build paths inside the project like this: BASE_DIR / 'subdir'.
BASE_DIR = Path(__file__).resolve().parent.parent

# Shurjopay Credentials
env = environ.Env()
environ.Env.read_env(BASE_DIR / '.env')
SP_USERNAME=env('SP_USERNAME')
SP_PASSWORD=env('SP_PASSWORD')
SHURJOPAY_API=env('SHURJOPAY_API')
SP_CALLBACK=env('SP_CALLBACK')
SP_LOG_DIR= BASE_DIR / 'logs' / 'shurjopay.log'

```

Now provide these configurations to initaialize the pugin

```
from django.conf import settings
sp_config = ShurjoPayConfigModel(
        SP_USERNAME = settings.SP_USERNAME,
        SP_PASSWORD = settings.SP_PASSWORD,
        SHURJOPAY_API = settings.SHURJOPAY_API,
        SP_CALLBACK = settings.SP_CALLBACK,
        SP_LOG_DIR = settings.SP_LOG_DIR
        )

shurjopay = ShurjopayPlugin(sp_config)
```

## [Github](https://github.com/shurjopay-plugins)

## Contacts

### [Shurjopay](https://shurjopay.com.bd/#contacts)
