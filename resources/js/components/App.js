import React, { Component } from 'react';
import axios from 'axios';
export default class App extends Component {
    constructor(props) {
        super(props)
        this.state = {
            name: ""
        };
        this.addToCartSpecific = this.addToCartSpecific.bind(this)
    }
    addToCartSpecific() {
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var id = $('input[name=product__id]').val();
        var cid = $('select[id=input-sort-color]').val();
        var sid = $('select[id=input-sort-size]').val();
        var quan = $('input[name=qty]').val();
        if (quan <= 0) {
            toastr.error("Quantity Must Be Greater Then Zero");
            return false;
        }
        if (cid <= 0) {
            toastr.error("Color Must be selected");
            return false;
        }
        if (sid <= 0) {
            toastr.error("Size Must Be Selected");
            return false;
        }
        $.ajax({
            url: window.location.origin+'/add/to/cart',
            type: 'post',
            data: {
                color_id: cid,
                size_id: sid,
                quantity: quan,
                product_id: id,
                _token: CSRF_TOKEN,
            },
            dataType: 'JSON',
            success: function (data) {
                console.log(data)
            }

        });
    }
    render() {
        return (
            <a onClick={this.addToCartSpecific}  data-tooltip="Add To Cart" className="add-cart add-cart-text"
               data-placement="left" tabIndex="0">Add To Cart<i className="fa fa-cart-plus"></i></a>
        );
    }
}