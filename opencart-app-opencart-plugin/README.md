
# What is this repository for?

ShurjoPay opencart plugin. Seamlessly pay your bill through shurjoPay in opencart.
Opencart version: 3.x.x

# Installation and Configuration:

## Step 1
* Install **opencart 3.0.3.8**
    *(standard installation process)*

## Step 2
* Download all contents from the **upload** folder in the github repo.

* Zip the folders **admin** and **catalog** together with a name extension: **“shurjopay.ocmod.zip”**

* Log in to the Admin panel, go to ->Extensions ->Installer, then **upload** the .ocmod.zip file.

![upload_plugin](https://user-images.githubusercontent.com/68351215/203031591-1c225180-d1db-4f9f-8000-75ec92915168.png)

* Go to Extensions->Extensions, select **Payments** in “Choose the extension type” filter.

![filter_payments](https://user-images.githubusercontent.com/68351215/203031697-fde6ee96-03e2-4d14-8e63-034aadb210f8.png)

* Find **ShurjoPay** there and click on the Install button.

* Then click on the Edit button to change the settings for the plugin.

![install_edit_plugin](https://user-images.githubusercontent.com/68351215/203031846-91b83ef0-c1ae-4667-a2f3-af2091a191cf.png)

* Save the shurjopay merchant credentials in Admin settings of the plugin.\
    _(select sandbox checkbox if you want to test in sandbox with sandbox credentials)_

    * **Order Status**: Processing
    * **Username**: Will be provided over email
    * **Password**: Will be provided over email
    * **Transaction Key**: Will Provide over email
    * **User IP**: Your hosting IP
    * **Status**: Enable
    
![shurjopay_credentials](https://user-images.githubusercontent.com/68351215/203031903-186ce07f-7d25-47c5-828b-8e1f09dd3d70.png)

## Step 3

* Download and install additional dependency extension **SEO URL issue fix in Opencart 3.x By Sainent** *(version 3.x(1.2))* from the opencart extension :
    [SEO URL issue fix in Opencart 3.x By Sainent](https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=31993&filter_member=sainent)
    
* Go to System -> Settings, select Server from the top menu, select radio button Yes for “Use SEO URLs”.

![on_seourl](https://user-images.githubusercontent.com/68351215/203032094-015b5e1c-a38e-4731-8bab-eecb43fa5975.png)

![select_seourl_op](https://user-images.githubusercontent.com/68351215/203032458-3bcfc47f-efc3-4fdb-9c51-d00e96e83b12.png)

* Now clear the cache from the Admin panel -> Dashboard.

![clear_cache_dashboard](https://user-images.githubusercontent.com/68351215/203032163-9aa0a1e8-70d2-4761-8930-dd589cade8cc.png)


* Go to Design -> SEO URL, click on “add new”.

![add_new_seo_url](https://user-images.githubusercontent.com/68351215/203032276-c4d0c25e-dc0e-48d6-86bb-a4ed02b699d1.png)

* Go to Admin Panel, go to Design ->SEO url 
    * create new SEO url with 
    ``QUERY = extension/payment/shurjopay/callback`` \
    ``KEYWORD = callback``
    
![add_seourl_callback](https://user-images.githubusercontent.com/68351215/203032322-3e283db8-260d-4d78-87cb-2e81e7ca8f53.png)

    
    * create new SEO url with 
    ``QUERY = extension/payment/shurjopay/ipnHandler`` \
    ``KEYWORD = ipn-listner``
    
    ![add_ipn_url](https://user-images.githubusercontent.com/68351215/203032360-96dc7fa7-0d5c-4112-af2f-7461f28397c4.png)


* Rewrite .htaccess and set root folder name of the project with “RewriteBase”
