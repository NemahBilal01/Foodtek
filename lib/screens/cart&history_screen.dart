import 'package:flutter/material.dart';
import 'package:firebasewithnotification/screens/cart_screen.dart';
import 'package:firebasewithnotification/screens/history_screen.dart';

class CartAndHistoryScreen extends StatefulWidget {
  const CartAndHistoryScreen({super.key});

  @override
  _CartAndHistoryScreenState createState() => _CartAndHistoryScreenState();
}

class _CartAndHistoryScreenState extends State<CartAndHistoryScreen> {
  int _selectedIndex = 2; // تحديد الصفحة الافتراضية (Cart)

  void _onItemTapped(int index) {
    setState(() {
      _selectedIndex = index;
    });
  }

  final List<Widget> _screens = [
    Placeholder(), // استبدلها بصفحة Home
    Placeholder(), // استبدلها بصفحة Favorites
    DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
          title: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: const [
              Text("Current location", style: TextStyle(fontSize: 14, color: Colors.grey)),
              Text("Jl. Soekarno Hatta 15A...", style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
            ],
          ),
          actions: [
            IconButton(
              icon: const Icon(Icons.notifications_outlined),
              onPressed: () {},
            ),
          ],
          bottom: const TabBar(
            tabs: [
              Tab(text: "Cart"),
              Tab(text: "History"),
            ],
            indicatorColor: Color(0XFF25AE4B),
            labelColor: Color(0XFF25AE4B),
            unselectedLabelColor: Color(0XFF98A0B4),
            labelStyle: TextStyle(fontSize: 16, fontWeight: FontWeight.w600),
          ),
        ),
        body:  TabBarView(
          children: [
            CartScreen(),
            HistoryScreen(),
          ],
        ),
      ),
    ),
    HistoryScreen(),// استبدلها بصفحة History
    Placeholder(), // استبدلها بصفحة Profile
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _screens[_selectedIndex],
      bottomNavigationBar: BottomNavigationBar(
        backgroundColor: Color(0XFFDBF4D1),
        currentIndex: _selectedIndex,
        selectedItemColor: Color(0XFF25AE4B), // لون العنصر المحدد
        unselectedItemColor: Color(0XFF484C52),// لون العناصر غير المحددة
        onTap: _onItemTapped,
        items: const [
          BottomNavigationBarItem(icon: Icon(Icons.home), label: 'Home'),
          BottomNavigationBarItem(icon: Icon(Icons.favorite_border), label: 'Favorites'),
          BottomNavigationBarItem(icon: Icon(Icons.shopping_cart, size: 30), label: ''),
          BottomNavigationBarItem(icon: Icon(Icons.history), label: 'History'),
          BottomNavigationBarItem(icon: Icon(Icons.person), label: 'Profile'),
        ],
      ),
    );
  }
}
