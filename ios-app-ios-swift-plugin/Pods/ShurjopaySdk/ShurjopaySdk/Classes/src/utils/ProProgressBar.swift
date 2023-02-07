//
//  ProProgressBar.swift
//  ShurjopaySdk
//
//  Created by Rz Rasel on 2022-05-12
//

import Foundation
import UIKit

public class ProProgressBar: UIVisualEffectView {
    var text: String? {
        didSet {
            label.text = text
        }
    }

    let activityIndictor:   UIActivityIndicatorView = UIActivityIndicatorView(style: UIActivityIndicatorView.Style.gray)
    //var activityIndictor:   UIActivityIndicatorView?
    let label:              UILabel                 = UILabel()
    let blurEffect                                  = UIBlurEffect(style: .light)
    let vibrancyView:       UIVisualEffectView

    init(label: String) {
        self.text           = label
        self.vibrancyView   = UIVisualEffectView(effect: UIVibrancyEffect(blurEffect: blurEffect))
        super.init(effect: blurEffect)
        self.setup()
    }

    required init?(coder aDecoder: NSCoder) {
        self.text           = "Loading..."
        self.vibrancyView   = UIVisualEffectView(effect: UIVibrancyEffect(blurEffect: blurEffect))
        super.init(coder: aDecoder)
        self.setup()
    }

    func setup() {
        contentView.addSubview(vibrancyView)
        contentView.addSubview(activityIndictor)
        contentView.addSubview(label)
        activityIndictor.startAnimating()
    }

    public override func didMoveToSuperview() {
        super.didMoveToSuperview()

        if let superview        = self.superview {
            let width           = superview.frame.size.width / 2.3
            let height: CGFloat = 50.0
            self.frame = CGRect(
                x:      superview.frame.size.width / 2 - width / 2,
                y:      superview.frame.height / 2 - height / 2,
                width:  width,
                height: height
            )
            vibrancyView.frame                  = self.bounds
            let activityIndicatorSize: CGFloat  = 40
            activityIndictor.frame = CGRect(
                x:      5,
                y:      height / 2 - activityIndicatorSize / 2,
                width:  activityIndicatorSize,
                height: activityIndicatorSize
            )

            layer.cornerRadius  = 8.0
            layer.masksToBounds = true
            label.text          = text
            label.textAlignment = NSTextAlignment.left
            label.frame = CGRect(
                x:      activityIndicatorSize + 5,
                y:      0,
                width:  width - activityIndicatorSize - 15,
                height: height
            )
            label.textColor     = UIColor.gray
            label.font          = UIFont.boldSystemFont(ofSize: 12)
        }
    }

    /*func show() {
        self.isHidden = false
    }*/
    func show(viewController: UIViewController) {
        self.isHidden = false
        viewController.view.addSubview(self)
    }

    func hide(viewController: UIViewController) {
        self.isHidden = true
        //self.removeFromSuperview()
        if let viewWithTag = viewController.view.viewWithTag(100) {
            viewWithTag.removeFromSuperview()
        }
    }
}
