package com.shurjomukhi.plugin.tester;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.shurjopay.plugin.Shurjopay;
import com.shurjopay.plugin.model.PaymentReq;
import com.shurjopay.plugin.model.PaymentRes;
import com.shurjopay.plugin.model.VerifiedPayment;
/**
 * 
 * @author Al - Amin
 * @since 2022-07-18
 */
@Service
public class ProductService {

	@Autowired
	private Shurjopay plugin;
	
	public PaymentRes buy(Product product) {
		PaymentReq request = new PaymentReq();

		request.setPrefix("sp");
		request.setAmount(product.getProductPrice());
		request.setOrderId("sp315689");
		request.setCurrency("BDT");
		request.setCustomerName("Maharab kibria");
		request.setCustomerAddress("Dhaka");
		request.setCustomerPhone("01766666666");
		request.setCustomerCity("Dhaka");
		request.setCustomerPostCode("1212");
		request.setClientIp("102.101.1.1");

		PaymentRes response = plugin.makePayment(request);
		

		return response;
	}

	public boolean verifyOrder(String orderId) {
		VerifiedPayment order = plugin.verifyPayment(orderId);
		
		return order.getSpStatusCode().equals("1000") ? true : false;
	}

	public VerifiedPayment checkPaymentStatus(String id) {
		
		return plugin.checkPaymentStatus(id);	
	}

}
