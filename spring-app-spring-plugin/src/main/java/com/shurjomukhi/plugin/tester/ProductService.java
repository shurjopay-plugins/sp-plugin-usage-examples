package com.shurjomukhi.plugin.tester;

import java.util.Objects;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.web.server.NotAcceptableStatusException;

import com.shurjomukhi.Shurjopay;
import com.shurjomukhi.ShurjopayException;
import com.shurjomukhi.constants.ShurjopayStatus;
import com.shurjomukhi.model.PaymentReq;
import com.shurjomukhi.model.PaymentRes;
import com.shurjomukhi.model.VerifiedPayment;

import lombok.extern.slf4j.Slf4j;
/**
 * 
 * @author Al - Amin
 * @since 2022-07-18
 */
@Service
@Slf4j
public class ProductService {

	// Initialize shurjopay
	private @Autowired Shurjopay shurjopay;
	
	public PaymentRes buy(Product product) {
		if (Objects.isNull(product)) throw new NotAcceptableStatusException("Product details must be provided to buy.");
		if (log.isDebugEnabled()) log.debug("Product details: {}", product);
		
		PaymentReq request = new PaymentReq();
		request.setPrefix("sp");
		request.setAmount(product.getPrice());
		request.setCustomerOrderId("sp315689");
		request.setCurrency("BDT");
		request.setCustomerName("Maharab kibria");
		request.setCustomerAddress("Dhaka");
		request.setCustomerPhone("01766666666");
		request.setCustomerCity("Dhaka");
		request.setCustomerPostCode("1212");
		request.setClientIp("102.101.1.1");

		try {
			return shurjopay.makePayment(request);
		} catch (ShurjopayException e) {

			log.error("Shurjopay exception occurred while making payment.", e);
			return null;
		}
	}

	public boolean verifyOrder(String orderId) {
		if (orderId.isBlank()) throw new NotAcceptableStatusException("Order id cann't be empty to verify payment.");
		if (log.isDebugEnabled()) log.debug("Requesting to verify payment using {} order id", orderId);
		try {
			var verifiedPayment = shurjopay.verifyPayment(orderId);
			if (log.isDebugEnabled()) log.debug("Verify Payment response: {}", verifiedPayment);
			
			return verifiedPayment.getSpStatusCode().equals(ShurjopayStatus.SHURJOPAY_SUCCESS.code());
		} catch (ShurjopayException e) {
			log.error("Shurjopay exception occurred while verifying payment", e);
			return false;
		}
	}

	public VerifiedPayment checkPaymentStatus(String orderId) {
		if (orderId.isBlank()) throw new NotAcceptableStatusException("Order id cann't be empty to verify payment.");
		if (log.isDebugEnabled(null)) log.debug("Requesting to verify payment using {} order id", orderId);
		
		try {
			var verifiedPayment = shurjopay.checkPaymentStatus(orderId);
			if (log.isDebugEnabled()) log.debug("Checking payment status response: {}", verifiedPayment);
			
			return shurjopay.checkPaymentStatus(orderId);
		} catch (ShurjopayException e) {
			log.error("Shurjopay exception occurred while checking payment status", e);
			return null;
		}	
	}
}
