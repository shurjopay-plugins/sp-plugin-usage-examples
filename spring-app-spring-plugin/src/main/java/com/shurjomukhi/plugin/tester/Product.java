package com.shurjomukhi.plugin.tester;

import java.io.Serializable;

import lombok.Data;
import lombok.experimental.Accessors;
/**
 * 
 * @author Al - Amin
 * @since 2022-07-18
 */
@Data
@Accessors(chain = true)
public class Product implements Serializable{
	private static final long serialVersionUID = 1L;
	
	private String name;
	private Double price;
}
