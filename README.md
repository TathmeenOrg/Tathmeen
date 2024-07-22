# نظام تثمين | لإدارة العروض المالية بجمعية عون التقنية #
![logo](https://github.com/user-attachments/assets/b2cc5f5a-94f7-4dfb-81fa-90f6ce9b0984)
![WhatsApp Image 1446-01-16 at 13 38 40](https://github.com/user-attachments/assets/c77aa0e8-352a-4f4b-96fc-5a6e37acfec0)


تم إنشاء جميع الجداول اللازمة للنظام في مجلد قاعدة البيانات (database) داخل مجلد (dist).
1. ## لإعداد الجداول وإضافة المدير العام الأساسي (super admin)، يرجى اتباع الخطوات التالية: ##

- افتح (terminal).

- انتقل إلى مجلد قاعدة البيانات داخل مجلد dist باستخدام الأمر التالي:

cd Tathmeen/database

- لإنشاء الجداول، قم بتنفيذ الأمر التالي:

php Create.php

- لإضافة المدير العام للنظام والبيانات الأساسية للنظام، قم بتنفيذ الأمر التالي:

php insert.php

2. ## لتشغيل أكواد استعادة كلمة المرور بدون اخطاء: ##
- افتح الرابط https://drive.google.com/file/d/1_BeSFfY1FhRJg_fO41wzS4K3crxccAqK/view?usp=sharing
-  قم بتنزيل مجلد "vendor" وفك ضغطه.
-  أنقل مجلد "vendor" داخل مجلد المشروع "Tathmeen".


** ملاحظة: تأكد من أن بيئة العمل لديك تم إعدادها بشكل صحيح لتشغيل أوامر PHP. **
