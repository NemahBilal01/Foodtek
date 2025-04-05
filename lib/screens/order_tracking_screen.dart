import 'package:flutter/material.dart';

class OrderTrackingScreen extends StatefulWidget {
  const OrderTrackingScreen({super.key});

  @override
  State<OrderTrackingScreen> createState() => _OrderTrackingScreenState();
}

class _OrderTrackingScreenState extends State<OrderTrackingScreen> {
  @override
  int _selectedIndex=3;
  void onItemTapped(int index){
    setState(() {
      _selectedIndex=index;
    });
  }
  final List<Widget>_screen=[
   Placeholder(),//Home
    Placeholder(),//Favourite
    Placeholder(),//Cart
    Placeholder(),//OrderTracking
    Placeholder(),//Profile

  ];
  Widget build(BuildContext context) {
    return Scaffold(
      body: _screen[_selectedIndex],
      bottomNavigationBar: BottomNavigationBar(
          backgroundColor: Color(0XFFDBF4D1),
          currentIndex: _selectedIndex,
          selectedItemColor: Color(0XFF25AE4B), // لون العنصر المحدد
          unselectedItemColor: Color(0XFF484C52), // لون العناصر غير المحددة
          onTap: onItemTapped,
          items: const[
            BottomNavigationBarItem(icon:Icon(Icons.home),label: 'Home',),
            BottomNavigationBarItem(icon: Icon(Icons.favorite_border),label: 'Favourits'),
            BottomNavigationBarItem(icon: Icon(Icons.shopping_cart),label: ''),
            BottomNavigationBarItem(icon: Icon(Icons.track_changes),label: 'Track'),
            BottomNavigationBarItem(icon: Icon(Icons.person),label: 'Profile'),
          ]
      ),
    );
  }
}
