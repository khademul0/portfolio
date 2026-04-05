# cPanel Deployment Guide for Laravel

Your Laravel project is now fully prepared and optimized for a standard cPanel environment! All assets have been minified, CDNs have been removed to prevent Tracking Blockers, and duplicate Alpine instances have been resolved.

## Deployment Architecture (The "Split Method")
For security, we will use the Split Method. You should **never** upload your entire `.env` file and application logic into the public `public_html` directory.

### 1. File Preparation
First, create a ZIP file of this entire `portfolio` directory on your computer.
> **Note:** Do **NOT** include the `node_modules` and `.git` folders in the ZIP. They are massive and not used on the live server.

### 2. Upload to cPanel File Manager
Log in to your cPanel -> **File Manager** and upload your ZIP file to your home directory (e.g., `/home/username/`), NOT inside `public_html`.
- Extract the ZIP file there.
- Rename the extracted folder to `portfolio_core` (or whatever you like, but remember the name).

Your structure should look like this:
```
/home/username/
  ├── portfolio_core/       <-- (Your uploaded backend code goes here)
  └── public_html/          <-- (This is where the web traffic goes)
```

### 3. Deploy the Public Files
- Go inside your newly uploaded `portfolio_core` folder.
- Move the **contents** of the `public/` directory into your `public_html/` directory.
- This includes the `build/` folder, images, `.htaccess`, and `cpanel_index.php`.

### 4. Activate the Target Index
- Inside `public_html`, **delete** the standard `index.php` file.
- **Rename** `cpanel_index.php` to `index.php`.
- Open the new `index.php` and make sure `$core_folder` perfectly matches the folder name you chose in step 2 (e.g., `portfolio_core`). 

### 5. Database Setup
1. In cPanel, go to **MySQL® Databases**.
2. Create a new database and a new user. Keep note of the password.
3. Assign the user to the database with **All Privileges**.
4. Go to **phpMyAdmin** and `import` your local database SQL file.

### 6. Environment Configuration (.env)
- Go back to `/home/username/portfolio_core/` and edit your `.env` file.
- Change the following values for production:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_URL=https://yourdomain.com`
   - `DB_DATABASE=your_cpanel_db_name`
   - `DB_USERNAME=your_cpanel_db_user`
   - `DB_PASSWORD=your_db_password`
