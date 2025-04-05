import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class CartProvider extends ChangeNotifier{
  List<Map<String,dynamic>> _cartItems=[];
  List<Map<String,dynamic>> get cartItems=>_cartItems;

  void addToCart(Map<String, dynamic> item) {
    bool itemExists = false;
    for (var cartItem in _cartItems) {
      if (cartItem['name'] == item['name']) {
        cartItem['quantity'] += 1;
        itemExists = true;
        break;
      }
    }
    if (!itemExists) {
      _cartItems.add({...item, 'quantity': 1});
    }
    notifyListeners();
  }

  void removeFromCart(String itemName){
    _cartItems.removeWhere((item)=>item['name']==itemName);
    notifyListeners();
  }

  void updateQuantity(String itemName, int change) {
    for (var cartItem in _cartItems) {
      if (cartItem['name'] == itemName) {
        cartItem['quantity'] += change;
        if (cartItem['quantity'] <= 0) {
          _cartItems.remove(cartItem);
        }
        break;
      }
    }
    notifyListeners();
  }
  double getTotalPrice() {
    return _cartItems.fold(0, (sum, item) => sum + (item['price'] * item['quantity']));
  }
  void clearCart() {
    _cartItems.clear(); // Assuming your cart items list is named _cartItems
    notifyListeners();
  }



}