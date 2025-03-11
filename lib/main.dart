import 'package:firebase_core/firebase_core.dart';
import 'package:flutter_localization/flutter_localization.dart';
import 'package:flutter_localizations/flutter_localizations.dart';

import 'package:firebasewithnotification/screens/delivery_screen.dart';
import 'package:firebasewithnotification/screens/food_selection_screen.dart';
import 'package:firebasewithnotification/screens/splash_screen.dart';
import 'package:firebasewithnotification/screens/welcome_screen.dart';
import 'package:flutter/material.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'components/applocal.dart';
import 'firebase_options.dart';
Future<void> main() async {
  await Firebase.initializeApp(
      options: DefaultFirebaseOptions.currentPlatform,);
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
       debugShowCheckedModeBanner: false,
      title: 'Flutter Demo',

      theme: ThemeData(


        colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
        useMaterial3: true,
      ),
      home: SplashScreen(),

         localizationsDelegates: [
           AppLocale.delegate,
           GlobalMaterialLocalizations.delegate,
           GlobalWidgetsLocalizations.delegate,
         ],
      supportedLocales: [
        Locale("en",""),
        Locale("ar",""),
      ],
      localeResolutionCallback: (currentLang,supportLang){
         if(currentLang!=null){
           for(Locale locale in supportLang){
             if(locale.languageCode==currentLang.languageCode){return currentLang;}
           }
           return supportLang.first;
         }
      },
          );



  }
}

