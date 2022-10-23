
package com.example.application;

import javax.swing.JFrame;
import javax.swing.JOptionPane;

import javafx.application.Platform;
import javafx.embed.swing.JFXPanel;
import javafx.scene.Scene;
import javafx.scene.web.WebView;

/**
 *
 * @author Md-Ashraf
 * 
 */
public class PaymentWindow {


	public PaymentWindow(String paymentUrl) {
		createWindow(paymentUrl);
	}
	
	/**
	 * It creates a JavaFx pane and load shurjopay payment page inside it.
	 * 
	 */
	private static void createWindow(String url) {
		JFrame frame = new JFrame("Shurjomukhi Payment");
 
		JFXPanel panel = new JFXPanel();
		frame.add(panel);
 
		//TODO add a loading animation view while loading url
		
		try {
			 Platform.runLater( () -> { 
				 
				  WebView webView = new WebView();
				  webView.getEngine() .load(url);
				  panel.setScene( new Scene( webView ));
				  });
			 
		} catch (Exception e) {
			 
			e.printStackTrace();
			JOptionPane.showMessageDialog(null, "Failed to Load");
			frame.dispose();
		}
 
		frame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		frame.setSize(800, 700);
		frame.setLocationRelativeTo(null);
		frame.setVisible(true);
		
		}
	}

