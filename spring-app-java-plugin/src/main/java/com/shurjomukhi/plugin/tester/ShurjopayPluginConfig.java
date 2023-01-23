package com.shurjomukhi.plugin.tester;

import com.shurjomukhi.Shurjopay;
import com.shurjomukhi.ShurjopayException;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

/**
 * Initialise and inject shurjo pay plugin bean.
 * @author Al - Amin
 * @since 2022-07-18
 */
@Configuration
public class ShurjopayPluginConfig {

	/**
	 * Initialise shurjo pay plugin
	 * @return shurjopay bean of type {@link Shurjopay}
	 * @throws ShurjopayException
	 */
	@Bean
	public Shurjopay shurjoPayPlugin() throws ShurjopayException {
		return new Shurjopay();
	}
}
