using Shurjopay.Plugin.Models;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddControllersWithViews();

// Shurjopay Secrets
builder.Services.Configure<ShurjopayConfig>(builder.Configuration.GetSection("Shurjopay"));

var app = builder.Build();

// Configure the HTTP request pipeline.
if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Home/Error");
    // The default HSTS value is 30 days. You may want to change this for production scenarios, see https://aka.ms/aspnetcore-hsts.
    app.UseHsts();
}

app.UseHttpsRedirection();
app.UseStaticFiles();

app.UseRouting();

app.UseAuthorization();

app.MapControllerRoute(
    name: "default",
    pattern: "{controller=Home}/{action=Index}/{id?}");


app.MapControllerRoute(
    name: "default",
    pattern: "{controller=Shurjopay}/{action=Details}/{order_id?}");

app.MapControllerRoute(
    name: "default",
    pattern: "{controller=Shurjopay}/{action=Ipn}/{order_id?}");

app.Run();
