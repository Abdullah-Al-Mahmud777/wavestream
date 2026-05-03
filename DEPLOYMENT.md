# WaveStream - Render Deployment Guide

## Prerequisites
- GitHub account
- Render account (https://render.com)
- Code pushed to GitHub repository

## Deployment Steps

### 1. Push Code to GitHub
```bash
git add .
git commit -m "Add Dockerfile for Render deployment"
git push origin main
```

### 2. Create New Web Service on Render

1. Go to https://render.com/dashboard
2. Click **"New +"** button
3. Select **"Web Service"**
4. Connect your GitHub repository
5. Select your **wavestream** repository

### 3. Configure Web Service

**Basic Settings:**
- **Name:** wavestream (or your preferred name)
- **Environment:** Docker
- **Region:** Choose closest to your users
- **Branch:** main
- **Dockerfile Path:** ./Dockerfile

**Instance Type:**
- Select **Free** plan

### 4. Environment Variables

Render will automatically use the `render.yaml` file, but you can also add manually:

**Required Variables:**
```
APP_NAME=WaveStream
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
APP_KEY=base64:YOUR_GENERATED_KEY
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

**Generate APP_KEY:**
- Render will auto-generate this, or
- Run locally: `php artisan key:generate --show`

### 5. Deploy

1. Click **"Create Web Service"**
2. Wait for deployment (5-10 minutes)
3. Render will build Docker image and deploy

### 6. Post-Deployment

After successful deployment:

1. **Access your app:** https://your-app-name.onrender.com
2. **Create admin user:** You may need to run seeder manually via Render Shell:
   ```bash
   php artisan db:seed --class=AdminUserSeeder
   ```

### 7. Access Render Shell (Optional)

To run commands on deployed app:
1. Go to your service dashboard
2. Click **"Shell"** tab
3. Run commands:
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminUserSeeder
   php artisan cache:clear
   ```

## Important Notes

### Database
- Using SQLite for free tier
- Database file: `database/database.sqlite`
- Data persists across deployments

### File Storage
- Uploaded files (songs, images) will be lost on redeployment
- For production, use external storage (AWS S3, Cloudinary)

### Free Tier Limitations
- App sleeps after 15 minutes of inactivity
- First request after sleep takes 30-60 seconds
- 750 hours/month free

### Admin Login
Default credentials (after seeding):
- Email: admin@wavestream.com
- Password: admin123

**Change these immediately after first login!**

## Troubleshooting

### Build Fails
- Check Dockerfile syntax
- Verify all files are committed to GitHub
- Check Render build logs

### App Not Loading
- Check environment variables
- Verify APP_KEY is set
- Check Render logs for errors

### Database Issues
- Ensure database.sqlite exists in database folder
- Run migrations via Render Shell
- Check file permissions

### 500 Error
- Set APP_DEBUG=true temporarily to see errors
- Check storage and cache permissions
- Verify .env variables

## Updating Your App

```bash
# Make changes locally
git add .
git commit -m "Your update message"
git push origin main
```

Render will automatically detect changes and redeploy.

## Custom Domain (Optional)

1. Go to service **Settings**
2. Click **"Custom Domain"**
3. Add your domain
4. Update DNS records as instructed
5. Update APP_URL environment variable

## Support

For issues:
- Check Render documentation: https://render.com/docs
- Check Laravel documentation: https://laravel.com/docs
- Review deployment logs in Render dashboard
