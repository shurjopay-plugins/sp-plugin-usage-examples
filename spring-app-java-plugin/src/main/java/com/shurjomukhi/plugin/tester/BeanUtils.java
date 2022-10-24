package com.shurjomukhi.plugin.tester;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

import com.shurjopay.plugin.Shurjopay;
/**
 * 
 * @author Al - Amin
 * @since 2022-07-18
 */
@Configuration
public class BeanUtils {

	@Bean
	public Shurjopay shurjoPayPlugin() {
		return new Shurjopay();
	}
}
