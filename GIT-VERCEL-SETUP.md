# 🚀 Setting Up Git + Vercel Integration

Your project is now ready for Git! Here's how to connect it to GitHub/GitLab and deploy to Vercel.

---

## ✅ What's Done

- ✅ Git repository initialized
- ✅ Initial commit created (all 102 files committed)
- ✅ Vercel configuration files ready (`vercel.json`, `api/index.php`)

---

## 📤 Step 1: Push to GitHub/GitLab/Bitbucket

### Option A: Create New Repository on GitHub (Recommended)

1. **Go to GitHub**: https://github.com/new
2. **Create a new repository**:
   - Name: `toms-pest-control-portal` (or your choice)
   - Make it **Public** or **Private** (your choice)
   - **DO NOT** initialize with README, .gitignore, or license
   - Click **Create repository**

3. **Push your code** (run these commands in your terminal):
```bash
cd "D:\Project\Toms pest control\laravel-app"
git remote add origin https://github.com/YOUR_USERNAME/toms-pest-control-portal.git
git branch -M main
git push -u origin main
```

Replace `YOUR_USERNAME` with your GitHub username.

### Option B: Use GitLab or Bitbucket

- **GitLab**: https://gitlab.com/projects/new
- **Bitbucket**: https://bitbucket.org/repo/create

Then follow similar steps to add remote and push.

---

## 🔗 Step 2: Connect Repository to Vercel

1. **Go to Vercel Dashboard**: https://vercel.com/dashboard
2. **Click "Add New..." → "Project"**
3. **Import your Git repository**:
   - Select GitHub/GitLab/Bitbucket (wherever you pushed)
   - Find your repository: `toms-pest-control-portal`
   - Click **Import**

4. **Configure Project Settings**:
   - **Framework Preset**: Leave as "Other" or "Vite"
   - **Root Directory**: `laravel-app` (if Vercel detects root, change it)
   - **Build Command**: Vercel will use your `vercel.json` settings
   - **Output Directory**: `public`
   - Click **Deploy**

---

## ⚙️ Step 3: Set Environment Variables in Vercel

After deployment starts, go to **Project Settings → Environment Variables** and add:

### Required Environment Variables:

| Variable | Value | Environment |
|----------|-------|-------------|
| `APP_ENV` | `production` | Production, Preview, Development |
| `APP_DEBUG` | `false` | Production, Preview, Development |
| `APP_KEY` | `base64:8j2N4ek6BRJYZvHD8V+ySGDGE20ieZZpaHKvHcX1mY8=` | Production, Preview, Development |
| `SESSION_DRIVER` | `cookie` | Production, Preview, Development |
| `CACHE_DRIVER` | `array` | Production, Preview, Development |
| `LOG_CHANNEL` | `stderr` | Production, Preview, Development |
| `APP_URL` | `https://your-project.vercel.app` | Production (update with your actual URL) |

**Note**: You already have these set via CLI, but verify in Vercel dashboard they're all there.

---

## 🎯 Step 4: Deploy & Test

1. **First deployment will happen automatically** when you import
2. **Wait for build to complete** (may take 5-10 minutes first time)
3. **Check deployment status** in Vercel dashboard
4. **Visit your site** at the provided Vercel URL

---

## 📝 Important Notes About Vercel + Laravel

### ⚠️ Current Limitation:
Vercel's PHP runtime (`vercel-php`) may have compatibility issues. If deployment fails, you may see errors about:
- PHP runtime not available
- Build errors with composer
- Missing PHP functions

### ✅ Alternative Solutions if Vercel Doesn't Work:

1. **Render** (https://render.com) - Native Laravel support
2. **Railway** (https://railway.app) - Great for Laravel
3. **Heroku** - Classic PHP hosting (paid)
4. **DigitalOcean App Platform** - PHP/Laravel support

### 🔧 If Vercel Works:
- Your site will auto-deploy on every `git push`
- You can set up preview deployments for PRs
- Easy environment variable management

---

## 🔄 Step 5: Future Deployments

After initial setup, deployments are automatic:

1. **Make changes** to your code
2. **Commit and push**:
   ```bash
   git add .
   git commit -m "Your commit message"
   git push
   ```
3. **Vercel automatically deploys** - check dashboard for status

---

## 🛠️ Troubleshooting

### Issue: Build fails on Vercel
- Check build logs in Vercel dashboard
- Ensure all environment variables are set
- Verify `vercel.json` configuration

### Issue: PHP runtime errors
- Vercel may not support Laravel well
- Consider switching to Render or Railway (they have native Laravel support)

### Issue: Routes not working
- Check `vercel.json` rewrites configuration
- Ensure `api/index.php` exists and points to `public/index.php`

---

## 📚 Useful Commands

### Check Git Status
```bash
git status
```

### View Commit History
```bash
git log --oneline
```

### Pull Latest Changes (if working with team)
```bash
git pull
```

### Create New Branch
```bash
git checkout -b feature/your-feature-name
```

---

## 🎉 Next Steps

1. ✅ Push to GitHub/GitLab
2. ✅ Connect to Vercel
3. ✅ Set environment variables
4. ✅ Deploy!
5. ✅ Test your portal online

---

## 📞 Need Help?

- **Vercel Docs**: https://vercel.com/docs
- **Laravel on Vercel**: May need alternative hosting
- **GitHub**: https://docs.github.com

**Your project is ready to go! 🚀**



