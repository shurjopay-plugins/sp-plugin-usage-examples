package com.shurjopay.android.android_app_kotlin_plugin

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import com.shurjopay.android.android_app_kotlin_plugin.databinding.ActivityMainBinding
import com.shurjopay.android.example.utils.Constants.Companion.SHURJOPAY_API
import com.shurjopay.android.example.utils.Constants.Companion.SP_PASS
import com.shurjopay.android.example.utils.Constants.Companion.SP_USER
import sp.plugin.android.v2.model.ShurjopayConfigs
import sp.plugin.android.v2.model.ShurjopayException
import sp.plugin.android.v2.model.ShurjopayRequestModel
import sp.plugin.android.v2.model.ShurjopaySuccess
import sp.plugin.android.v2.payment.PaymentResultListener
import sp.plugin.android.v2.payment.Shurjopay
import java.util.*

class MainActivity : AppCompatActivity() {
    private val TAG = "MainActivity"
    private lateinit var binding: ActivityMainBinding

    var shurjopay: Shurjopay? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        shurjopay = Shurjopay(
            ShurjopayConfigs(
                username = SP_USER,
                password = SP_PASS,
                baseUrl = SHURJOPAY_API
            )
        )

        binding.submitButton.setOnClickListener {
            pay()
        }

    }

    private fun pay() {

        val data = ShurjopayRequestModel(
            "sp",
            "BDT",
            binding.amountLayout.editText?.text.toString().toDouble(),
            "NOK" + Random().nextInt(1000000),
            null,
            null,
            binding.nameLayout.editText?.text.toString(),
            binding.phoneLayout.editText?.text.toString(),
            null,
            binding.addressLayout.editText?.text.toString(),
            binding.cityLayout.editText?.text.toString(),
            null,
            null,
            null,
            "https://www.sandbox.shurjopayment.com/return_url",
            "https://www.sandbox.shurjopayment.com/cancel_url",
            "127.0.0.1",
            "value-of-1",
            "value-of-2",
            "value-of-3",
            "value-of-4"
        )

        shurjopay?.makePayment(
            this,
            data,
            object : PaymentResultListener {
                override fun onSuccess(success: ShurjopaySuccess) {
                    Log.d(TAG, "onSuccess: debugMessage = ${success.debugMessage}")
                }

                override fun onFailed(exception: ShurjopayException) {
                    Log.d(TAG, "onFailed: debugMessage = ${exception.debugMessage}")
                }

                override fun onBackButtonListener(exception: ShurjopayException): Boolean {
                    Log.d(TAG, "onBackButton: debugMessage = ${exception.debugMessage}")
                    return true
                }

            })

    }

    // this method only needed if user choose to use token for other shurjopay operation
    private fun token() {

        shurjopay?.getToken(this, object: PaymentResultListener {
            override fun onSuccess(success: ShurjopaySuccess) {
                Log.d(TAG, "onSuccess: debugMessage = ${success.debugMessage}")
            }

            override fun onFailed(exception: ShurjopayException) {
                Log.d(TAG, "onFailed: debugMessage = ${exception.debugMessage}")
            }

            override fun onBackButtonListener(exception: ShurjopayException): Boolean {
                Log.d(TAG, "onBackButton: debugMessage = ${exception.debugMessage}")
                return true
            }

        })

    }
}