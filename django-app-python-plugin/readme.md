![alt text](https://shurjopay.com.bd/dev/images/shurjoPay.png)

# ShurjoPay Online Payment API Integration:

This document has been prepared by Shurjomukhi Limited to enable the online merchants to integrate shurjoPay payment gateway. The information contained in this document is proprietary and confidential to Shurjomukhi Limited, for the product Shurjopay.

# Audience

This document is intended for the technical personnel of merchants and service providers that want to integrate a new online payment gateway using python plugin provided by shurjoPay.

## Django Example Projcet

First of all, developers have to configure a .env file in their respective project with four variables, which are SP_USERNAME,
SP_PASSWORD, SHURJOPAY_API, SP_CALLBACK and use these to configure the ShurjopayConfigModel to create a instance of Shurjopay python plugin

- **Shurjopay Credentials**

```env
SP_USERNAME=sp_sandbox
SP_PASSWORD=pyyk97hu&6u6
SHURJOPAY_API=https://sandbox.shurjopayment.com/api/
SP_CALLBACK=https://sandbox.shurjopayment.com/response/
```

> 📝 **NOTE** For Shurjopay version 3 live engine integration all necessary credential will be given to merchant after subscription completed on Shurjopay gateway.

# Installation

> 📝 **NOTE** Install the package inside your django project environment

Use the package manager `pip` to install Shuropay python package

```
pip install shurjopay-v3
```

To install Python package from github, you need to clone the repository.

```
git clone https://github.com/shurjopay-plugins/sp-plugin-python
```

Then just run the setup.py file from that directory,

```
python setup.py install
```

## Documentation

### [Developer-Guideline](doc/sp_plugin_developer_guideline.md)

### [Github](https://github.com/shurjopay-plugins)

## Contacts

[Shurjopay](https://shurjopay.com.bd/#contacts)
