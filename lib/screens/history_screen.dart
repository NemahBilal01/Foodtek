import 'package:firebasewithnotification/providers/cart_provider.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:firebasewithnotification/providers/order_provider.dart';

class HistoryScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    final orderProvider = context.watch<OrderProvider>();
    final orderHistory = orderProvider.orders;

    return Scaffold(
      backgroundColor: Colors.white,
      body: orderHistory.isEmpty
          ? _buildEmptyState()
          : _buildOrderList(orderHistory),
    );
  }


  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Image.asset("images/Empty State.png", width: 282,height: 282,),
          SizedBox(height: 20),
          Text(
            "History Empty",
            style: TextStyle(fontSize: 32, fontWeight: FontWeight.w700,color: Color(0XFF111827)),
          ),
          SizedBox(height: 8),
          Text(
            "You don’t have order any foods before",
            style: TextStyle(fontSize: 16, color: Color(0XFF6C7278),fontWeight: FontWeight.w500),
            textAlign: TextAlign.center,
          ),
        ],
      ),
    );
  }


  Widget _buildOrderList(List<Map<String, dynamic>> orderHistory) {
    return ListView.builder(
      padding: EdgeInsets.symmetric(vertical: 10, horizontal: 16),
      itemCount: orderHistory.length + 1,
      itemBuilder: (context, index) {
        if (index == orderHistory.length) {

          return Center(
            child: Padding(
              padding: const EdgeInsets.symmetric(vertical: 12),
              child: TextButton(
                onPressed: () {

                },
                child: Text(
                  'Load More..',
                  style: TextStyle(
                    color: Color(0XFF25AE4B),
                    fontSize: 14,
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
            ),
          );
        }

        final order = orderHistory[index];
        final firstItem = order['items'].isNotEmpty ? order['items'][0] : null;

        return Container(
          margin: EdgeInsets.only(bottom: 12),
          padding: EdgeInsets.all(12),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(7),
            border: Border.all(color: Color(0XFFDBF4D1)),
          ),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              if (firstItem != null)
                ClipRRect(
                  borderRadius: BorderRadius.circular(7),
                  child: Image.asset(
                    firstItem['image'],
                    width: 62.18,
                    height: 62,
                    fit: BoxFit.cover,
                  ),
                ),
              SizedBox(width: 12),


              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      firstItem != null ? firstItem['name'] : "Order #${index + 1}",
                      style: TextStyle(fontSize: 15, fontWeight: FontWeight.w500, color: Colors.black),
                    ),
                    Text(
                      firstItem != null ? firstItem['restaurant'] : "Items: ${order['items'].length}",
                      style: TextStyle(fontSize: 12, fontWeight: FontWeight.w400, color: Color(0XFF3B3B3B)),
                    ),
                    SizedBox(height: 4),
                    Text(
                      "\$${order['totalPrice']}",
                      style: TextStyle(
                        fontSize: 19,
                        fontWeight: FontWeight.w700,
                        color: Color(0XFF25AE4B),
                      ),
                    ),
                  ],
                ),
              ),


              Column(
                crossAxisAlignment: CrossAxisAlignment.end,
                children: [
                  Row(
                    children: [
                      Icon(Icons.access_time, color: Color(0XFF25AE4B), size: 18),
                      SizedBox(width: 4),
                      Text(
                        "${order['date'].toString().split(' ')[0]}",
                        style: TextStyle(
                          color: Color(0XFF3B3B3B),
                          fontSize: 12,
                          fontWeight: FontWeight.w700,
                        ),
                      ),
                    ],
                  ),
                  SizedBox(height: 8),
                  Row(
                    children: [
                      Icon(Icons.rotate_left, color: Color(0XFF25AE4B), size: 18),
                      SizedBox(width: 4),
                      TextButton(
                        onPressed: () {
                          _reorder(context, order['items']);
                        },
                        child: Text(
                          'Reorder',
                          style: TextStyle(
                            color: Color(0XFF25AE4B),
                            fontSize: 12,
                            fontWeight: FontWeight.w700,
                          ),
                        ),
                      ),
                    ],
                  )
                ],
              ),
            ],
          ),
        );
      },
    );
  }



  void _reorder(BuildContext context, List<Map<String, dynamic>> items) {
    final cartProvider = context.read<CartProvider>();
    for (var item in items) {
      cartProvider.addToCart(item);
    }
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text("Items added to cart"),
        backgroundColor: Color(0XFF25AE4B),
      ),
    );
  }
}
