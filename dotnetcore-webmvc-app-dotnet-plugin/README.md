# .Net core web application using Shurjopay .Net Plugin 

##### This is an example application made with .net core web mvc using Shurjopay dotnet plugin to integrate shurjoPay payment system to the application.

## How to Run

- Clone repository to your local directory.
- Import it in your  Visual Studio/Rider IDE
- Install [Shurjopay .Net Plugin](https://www.nuget.org/packages/ShurjopayPlugin/)
```
Install-Package ShurjopayPlugin
```
- Add your Shurjopay configurations inside secrets.json
```json
"Shurjopay": {
    "SP_USERNAME": "demo",
    "SP_PASSWORD": "demowb4&n$6un28$",
    "SP_ENDPOINT": "https://engine.shurjopayment.com/api/",
    "SP_CALLBACK": "https://localhost:7256/shurjopay/",
    "SP_PREFIX": "DEM"
  }
```
- Run the application



## shurjoPay is also extended with the following plugins:
Instructions on how to use them in your own application are linked below.

| Plugin | Link |
| ------ | ------ |
| Java Plugin | [Java plugin link](https://github.com/shurjopay-plugins/sp-plugin-java) |
| Python-Plugin |[Python plugin link](https://github.com/shurjopay-plugins/sp-plugin-python) |
| All Plugin List| [All plugin list](https://github.com/shurjopay-plugins) |



