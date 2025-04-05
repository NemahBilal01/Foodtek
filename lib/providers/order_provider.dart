import 'package:flutter/foundation.dart';

class OrderProvider extends ChangeNotifier {
  List<Map<String, dynamic>> _orders = [];
  List<Map<String, dynamic>> get orders => _orders;

  void addOrder(List<Map<String, dynamic>> cartItems, double totalPrice) {
    _orders.add(
        {
          'items': List<Map<String, dynamic>>.from(cartItems),
          'totalPrice': totalPrice,
          'date': DateTime.now(),
        }
    );
    notifyListeners();
  }
}