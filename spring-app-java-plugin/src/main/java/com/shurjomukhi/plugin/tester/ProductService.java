package com.shurjomukhi.plugin.tester;

import com.shurjomukhi.Shurjopay;
import com.shurjomukhi.ShurjopayException;
import com.shurjomukhi.constants.ShurjopayStatus;
import com.shurjomukhi.model.PaymentReq;
import com.shurjomukhi.model.PaymentRes;
import com.shurjomukhi.model.VerifiedPayment;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.web.server.NotAcceptableStatusException;

import java.util.Objects;
/**
 * Payment process handle by this class as like
 * <p>Process purchase request with demo static user name and password.</p>
 * <p>Check and verify order ID.</p>
 * <p>Check payment status is payed or not.</p>
 * @author Al - Amin
 * @since 2022-07-18
 */
@Service
@Slf4j
public class ProductService {

	@Autowired
	private Shurjopay plugin;

	/**
	 * Process payment request with demo static user name and password.
	 * @param product {@link Product}
	 * @return payment response
	 */
	public PaymentRes buy(Product product) {
		if (Objects.isNull(product)) throw new NotAcceptableStatusException("Product details must be provided to buy.");
		if (log.isDebugEnabled()) log.debug("Product details: {}", product);
		
		product.setName("Pen");
		product.setPrice(1.0);
		
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
			return plugin.makePayment(request);
		} catch (ShurjopayException e) {

			log.error("Shurjopay exception occurred while making payment.", e);
			return null;
		}
	}

	/**
	 * Check and verify order ID.
	 * @param orderId of type {@link String}
	 * @return true if oder ID is verified otherwise false.
	 */
	public boolean verifyOrder(String orderId) {
		if (orderId.isBlank()) throw new NotAcceptableStatusException("Order id cann't be empty to verify payment.");
		if (log.isDebugEnabled()) log.debug("Requesting to verify payment using {} order id", orderId);
		try {
			var verifiedPayment = plugin.verifyPayment(orderId);
			if (log.isDebugEnabled()) log.debug("Verify Payment response: {}", verifiedPayment);
			
			return verifiedPayment.getSpStatusCode().equals(ShurjopayStatus.SHURJOPAY_SUCCESS.code());
		} catch (ShurjopayException e) {
			log.error("Shurjopay exception occurred while verifying payment", e);
			return false;
		}
	}

	/**
	 * Check payment status is payed or not.
	 * @param orderId  of type {@link String}
	 * @return verifiedPayment if order is verified otherwise null.
	 */
	public VerifiedPayment checkPaymentStatus(String orderId) {
		if (orderId.isBlank()) throw new NotAcceptableStatusException("Order id cann't be empty to verify payment.");
		if (log.isDebugEnabled(null)) log.debug("Requesting to verify payment using {} order id", orderId);
		
		try {
			var verifiedPayment = plugin.checkPaymentStatus(orderId);
			if (log.isDebugEnabled()) log.debug("Checking payment status response: {}", verifiedPayment);
			
			return plugin.checkPaymentStatus(orderId);
		} catch (ShurjopayException e) {
			log.error("Shurjopay exception occurred while checking payment status", e);
			return null;
		}	
	}
}
