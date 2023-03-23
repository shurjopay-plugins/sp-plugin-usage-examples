# Generated by Django 4.1.7 on 2023-03-23 06:27

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('shurjopay', '0006_rename_marchenttable_marchentorder'),
    ]

    operations = [
        migrations.CreateModel(
            name='PaymentDetails',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('checkout_url', models.URLField()),
                ('amount', models.DecimalField(decimal_places=2, max_digits=10)),
                ('currency', models.CharField(max_length=3)),
                ('sp_order_id', models.CharField(max_length=100)),
                ('customer_order_id', models.CharField(max_length=100)),
                ('customer_name', models.CharField(max_length=100)),
                ('customer_address', models.CharField(max_length=200)),
                ('customer_city', models.CharField(max_length=100)),
                ('customer_phone', models.CharField(max_length=20)),
                ('customer_email', models.EmailField(max_length=254)),
                ('client_ip', models.GenericIPAddressField()),
                ('intent', models.CharField(max_length=10)),
                ('transactionStatus', models.CharField(max_length=20)),
            ],
        ),
        migrations.CreateModel(
            name='VerifiedPayment',
            fields=[
                ('id', models.IntegerField(primary_key=True, serialize=False)),
                ('order_id', models.CharField(max_length=255)),
                ('currency', models.CharField(max_length=10)),
                ('amount', models.DecimalField(decimal_places=4, max_digits=10)),
                ('payable_amount', models.DecimalField(decimal_places=4, max_digits=10)),
                ('discount_amount', models.DecimalField(decimal_places=4, max_digits=10)),
                ('disc_percent', models.IntegerField()),
                ('recived_amount', models.DecimalField(decimal_places=4, max_digits=10, null=True)),
                ('usd_amt', models.DecimalField(decimal_places=4, max_digits=10)),
                ('usd_rate', models.IntegerField()),
                ('card_holder_name', models.CharField(max_length=255, null=True)),
                ('card_number', models.CharField(max_length=255, null=True)),
                ('phone_no', models.CharField(max_length=255, null=True)),
                ('bank_trx_id', models.CharField(max_length=255, null=True)),
                ('invoice_no', models.CharField(max_length=255, null=True)),
                ('bank_status', models.CharField(max_length=255, null=True)),
                ('customer_order_id', models.CharField(max_length=255, null=True)),
                ('sp_code', models.CharField(max_length=10)),
                ('sp_massage', models.CharField(max_length=255)),
                ('sp_message', models.CharField(max_length=255)),
                ('name', models.CharField(max_length=255)),
                ('email', models.EmailField(max_length=254, null=True)),
                ('address', models.CharField(max_length=255)),
                ('city', models.CharField(max_length=255)),
                ('value1', models.CharField(max_length=255, null=True)),
                ('value2', models.CharField(max_length=255, null=True)),
                ('value3', models.CharField(max_length=255, null=True)),
                ('value4', models.CharField(max_length=255, null=True)),
                ('transaction_status', models.CharField(max_length=255, null=True)),
                ('method', models.CharField(max_length=255, null=True)),
                ('date_time', models.DateTimeField(null=True)),
            ],
        ),
        migrations.DeleteModel(
            name='OrderHistory',
        ),
        migrations.AlterField(
            model_name='sptransactions',
            name='bank_status',
            field=models.CharField(max_length=20, null=True),
        ),
        migrations.AlterField(
            model_name='sptransactions',
            name='bank_trnx_id',
            field=models.CharField(max_length=20, null=True),
        ),
        migrations.AlterField(
            model_name='sptransactions',
            name='payment_channel',
            field=models.CharField(max_length=20, null=True),
        ),
        migrations.AlterField(
            model_name='sptransactions',
            name='receivable_amount',
            field=models.DecimalField(decimal_places=2, max_digits=10, null=True),
        ),
        migrations.AlterField(
            model_name='sptransactions',
            name='sp_tx_time',
            field=models.DateTimeField(null=True),
        ),
        migrations.AlterField(
            model_name='sptransactions',
            name='tx_status_details',
            field=models.CharField(max_length=50, null=True),
        ),
        migrations.AlterField(
            model_name='sptransactions',
            name='tx_init_res',
            field=models.OneToOneField(null=True, on_delete=django.db.models.deletion.CASCADE, to='shurjopay.paymentdetails'),
        ),
        migrations.AlterField(
            model_name='sptransactions',
            name='tx_vrfy_res',
            field=models.OneToOneField(null=True, on_delete=django.db.models.deletion.CASCADE, to='shurjopay.verifiedpayment'),
        ),
    ]
