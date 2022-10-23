package com.example.services;

import com.shurjopay.plugin.model.PaymentReq;
import com.shurjopay.plugin.model.PaymentRes;
import com.example.model.PaymentInfo;
import com.shurjopay.plugin.Shurjopay;
import com.shurjopay.plugin.model.VerifiedPayment;

/**
 *
 * @author Md-Ashraf
 */
public class PaymentService {

	/*
	 * This service method use sp-java-plugin and call on makePayment(PaymentReq
	 * req) method to complete payment opertation. It need instance of PaymentInfo
	 * class to feed payment data to the plugin makePayment(PaymentReq req) method.
	 */
	public PaymentRes makePayment(PaymentInfo payInfo) {

		Shurjopay shurjopay = new Shurjopay();
		PaymentReq req = mapPaymentRequest(payInfo);
		PaymentRes paymentRes = shurjopay.makePayment(req);

		System.out.println(paymentRes.getPaymentUrl());

		return paymentRes;
	}
	

	/*
	 * This method verify the orderId of already completed payment opration . It
	 * call on sp-java-pluginsc verifyPayment(String orderId) method to complete its
	 * operation.
	 */
	public VerifiedPayment verification(PaymentRes res) {
		Shurjopay shurjopay = new Shurjopay();

		VerifiedPayment vp = shurjopay.verifyPayment(res.getSpOrderId());
		return vp;

	}

	public VerifiedPayment checkPaymentStatus(VerifiedPayment vp) {
		Shurjopay shurjopay = new Shurjopay();
		VerifiedPayment checkPaymentStatus = shurjopay.checkPaymentStatus(vp.getOrderId());
		System.out.println(checkPaymentStatus.toString());

		return checkPaymentStatus;

	}

	/* This method map PaymentReq class from PaymentInfo class */
	private PaymentReq mapPaymentRequest(PaymentInfo payInfo) {

		PaymentReq req = new PaymentReq();

		req.setPrefix(payInfo.getPrefix());
		req.setAmount(payInfo.getAmount());
		req.setOrderId(payInfo.getOrderId());
		req.setCurrency(payInfo.getCurrency());
		req.setCustomerName(payInfo.getCustomerName());
		req.setCustomerAddress(payInfo.getCustomerAddress());
		req.setCustomerCity(payInfo.getCustomerCity());
		req.setCustomerPhone(payInfo.getCustomerPhone());
		req.setCustomerPostCode(payInfo.getCustomerPostCode());
		req.setStoreId(payInfo.getStoreId());

		System.out.println(req.toString());

		return req;

	}

}
