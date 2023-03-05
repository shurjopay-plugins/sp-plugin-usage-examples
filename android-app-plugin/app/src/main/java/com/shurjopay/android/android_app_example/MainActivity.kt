package com.shurjopay.android.android_app_example

import android.os.Build
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import androidx.annotation.RequiresApi
import bd.com.shurjomukhi.v2.model.PaymentReq
import bd.com.shurjomukhi.v2.model.ShurjopayConfigs
import bd.com.shurjomukhi.v2.model.ShurjopayException
import bd.com.shurjomukhi.v2.model.ShurjopaySuccess
import bd.com.shurjomukhi.v2.payment.PaymentResultListener
import bd.com.shurjomukhi.v2.payment.Shurjopay
import com.shurjopay.android.android_app.databinding.ActivityMainBinding
import com.shurjopay.android.example.utils.Constants.Companion.SHURJOPAY_API
import com.shurjopay.android.example.utils.Constants.Companion.SP_PASS
import com.shurjopay.android.example.utils.Constants.Companion.SP_USER

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

        val data = PaymentReq(
            "sp",
            binding.amountLayout.editText?.text.toString().toDouble(),
            "NOK" + Random().nextInt(1000000),
            "BDT",
            binding.nameLayout.editText?.text.toString(),
            binding.addressLayout.editText?.text.toString(),
            binding.phoneLayout.editText?.text.toString(),
            binding.cityLayout.editText?.text.toString(),
            "1200",
            "m.zaman000@gmail.com",
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

    // this method only needed if user has order_id to use check payment status
    @RequiresApi(Build.VERSION_CODES.M)
    private fun checkStatus(order_id: String) {

        shurjopay?.verifyPayment(this,
            order_id,
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
}