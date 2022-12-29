package com.swing.example.services;

import com.shurjomukhi.Shurjopay;
import com.shurjomukhi.ShurjopayException;
import com.shurjomukhi.model.PaymentReq;
import com.shurjomukhi.model.PaymentRes;
import com.shurjomukhi.model.VerifiedPayment;
import com.swing.example.model.PaymentInfo;

/**
 *
 * @author Ashraful Islam
 */
public class PaymentService {

	/**
	 * This service method use sp-java-plugin and call on makePayment(PaymentReq
	 * req) method to complete payment operation. It need instance of PaymentInfo
	 * class to feed payment data to the plugin makePayment(PaymentReq req) method.
	 */
	public PaymentRes makePayment(PaymentInfo payInfo) throws ShurjopayException {

		Shurjopay shurjopay = new Shurjopay();
		PaymentReq req = mapPaymentRequest(payInfo);
		PaymentRes paymentRes = shurjopay.makePayment(req);

		System.out.println(paymentRes.getPaymentUrl());

		return paymentRes;
	}
	

	/**
	 * This method verify the orderId of already completed payment operation . It
	 * call on sp-java-plugin verifyPayment(String orderId) method to complete its
	 * operation.
	 */
	public VerifiedPayment verification(PaymentRes res) throws ShurjopayException {
		Shurjopay shurjopay = new Shurjopay();

		VerifiedPayment vp = shurjopay.verifyPayment(res.getSpTxnId());
		return vp;

	}

	public VerifiedPayment checkPaymentStatus(VerifiedPayment vp) throws ShurjopayException {
		Shurjopay shurjopay = new Shurjopay();
		VerifiedPayment checkPaymentStatus = shurjopay.checkPaymentStatus(vp.getCustomerOrderId());
		System.out.println(checkPaymentStatus.toString());

		return checkPaymentStatus;

	}

	/** This method map PaymentReq class from PaymentInfo class */
	private PaymentReq mapPaymentRequest(PaymentInfo payInfo) {

		PaymentReq req = new PaymentReq();

		req.setPrefix(payInfo.getPrefix());
		req.setAmount(payInfo.getAmount());
		req.setCustomerOrderId(payInfo.getCustomerOrderId());
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
