package com.example.application;

import com.shurjopay.plugin.model.PaymentRes;
import com.example.model.PaymentInfo;
import com.example.services.PaymentService;
import com.shurjopay.plugin.model.VerifiedPayment;
import java.awt.Color;
import java.awt.Container;
import java.awt.Cursor;
import java.awt.FlowLayout;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;
import javax.swing.SwingUtilities;

/**
 *
 * @author Md-Ashraf
 */
public class ExampleAppHome extends JFrame {

	private PaymentService service;
	private PaymentRes paymentRes = null;
	private VerifiedPayment verifiedPayment;

	private static ExampleAppHome jFrame;
	private Container container;
	private JLabel jLabel, imgLabel, orderIdLabel;
	private JTextField amountTextField;
	private Font customFont;
	private JButton payButton, clearButton, verifyButton;
	Cursor handCursor;
	ImageIcon img;

	public ExampleAppHome() {
		this.service = new PaymentService();
		initComponents();
	}

	/*
	 * This is main method of this example application where the application is
	 * initiated
	 */
	public static void main(String[] args) {

		jFrame = new ExampleAppHome();

		jFrame.setVisible(true);
		jFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		jFrame.setBounds(200, 200, 800, 600);
		jFrame.setLocationRelativeTo(null);
		jFrame.setTitle("Payment Window");

	}

	/*
	 * This method is create UI elements and set event listener to the UI
	 * components.
	 */
	private void initComponents() {

		container = this.getContentPane();
		container.setBackground(Color.gray);
		container.setLayout(null);

		customFont = new Font("Arial", Font.BOLD, 18);

		img = new ImageIcon(this.getClass().getResource("homePageImage.jpg"));
		imgLabel = new JLabel(img, JLabel.CENTER);
		imgLabel.setLayout(new FlowLayout());
		imgLabel.setBounds(50, 50, img.getIconWidth(), 300);

		orderIdLabel = new JLabel("Payment id");
		orderIdLabel.setBounds(400, 200, 300, 50);
		orderIdLabel.setFont(customFont);
		orderIdLabel.setForeground(Color.green);
		orderIdLabel.setVisible(true);

		jLabel = new JLabel("Please Enter Payment amount : ");
		jLabel.setBounds(50, 400, 300, 50);
		jLabel.setFont(customFont);
		jLabel.setForeground(Color.red);
		jLabel.setOpaque(true);
		jLabel.setHorizontalAlignment((int) CENTER_ALIGNMENT);

		jLabel.setBackground(Color.BLUE);

		amountTextField = new JTextField();
		amountTextField.setBounds(400, 400, 300, 50);
		amountTextField.setFont(customFont);
		amountTextField.setHorizontalAlignment((int) CENTER_ALIGNMENT);
		amountTextField.setForeground(Color.BLUE);

		handCursor = new Cursor(Cursor.HAND_CURSOR);

		clearButton = new JButton("Clear");
		clearButton.setBounds(400, 500, 100, 30);
		clearButton.setForeground(Color.red);
		clearButton.setFont(customFont);
		clearButton.setCursor(handCursor);
		clearButton.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {

				resetView();
			}

		});

		payButton = new JButton("Pay");
		payButton.setBounds(600, 500, 100, 30);
		payButton.setForeground(Color.blue);
		payButton.setFont(customFont);
		payButton.setCursor(handCursor);

		payButton.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {

				makePayment();
			}

		});

		verifyButton = new JButton("Veryify Payment");
		verifyButton.setBounds(400, 300, 200, 50);
		verifyButton.setForeground(Color.black);
		verifyButton.setFont(customFont);
		verifyButton.setCursor(handCursor);
		verifyButton.setVisible(false);
		verifyButton.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {

				verifyOrder();
			}

		});

		//container.add(orderIdLabel);
		container.add(imgLabel);
		container.add(jLabel);
		container.add(amountTextField);
		container.add(payButton);
		container.add(clearButton);
		container.add(verifyButton);

	}

	/* 
	 * This method reset UI and get it ready for new payment operation
	 * 
	 */
	private void resetView() {

		imgLabel.setBounds(50, 50, img.getIconWidth(), 300);
		container.remove(orderIdLabel);
		verifyButton.setVisible(false);
		amountTextField.setText("");

	}

	
	
	/*
	 * This method call payment service api and complete payment and proccess the
	 * response and reflect it on UI.
	 */
	private void makePayment() {

		if (amountTextField.getText().isEmpty()) {
			JOptionPane.showMessageDialog(null, "Please Enter Payment amount");
		} else {
			int choice = JOptionPane.showConfirmDialog(null, "Are you sure?", "Payment Confiramation",
					JOptionPane.YES_NO_OPTION);
			if (choice == JOptionPane.YES_OPTION) {

				try {
					PaymentInfo paymentInfo = new PaymentInfo();
					paymentInfo.setAmount(Double.parseDouble(amountTextField.getText().trim()));
					paymentRes = service.makePayment(paymentInfo);

					JOptionPane.showMessageDialog(null, "Payment Successfull");

					imgLabel.setBounds(50, 50, 300, 300);
					orderIdLabel.setText("Order Id = " + paymentRes.getSpOrderId());
					verifyButton.setVisible(true);
					container.add(orderIdLabel);
					container.revalidate();
					container.repaint();

					openPaymentWindow();

				} catch (Exception exp) {
					exp.printStackTrace();
					JOptionPane.showMessageDialog(null, "Payment Failed");
				}
			}
		}
	}

	
	/*
	 * This method verify the payment order that is already paid with makePayment
	 * method.
	 */
	private void verifyOrder() {
		try {
			verifiedPayment = service.verification(paymentRes);
			orderIdLabel.setText(paymentRes.getSpOrderId() + " verification Success");
			orderIdLabel.setForeground(Color.green);
		} catch (Exception e2) {
			e2.printStackTrace();
			orderIdLabel.setText(paymentRes.getSpOrderId() + " Verification failed");
			orderIdLabel.setForeground(Color.red);
		}
	}

	/* This is to open payment page inside a swing-javaFx window */
	private void openPaymentWindow() {
		new PaymentWindow(paymentRes.getPaymentUrl());
	}

}
