# ServiceM8 Integration Setup Guide

## ✅ What's Been Set Up

1. **Webhook Endpoint** - Ready to receive webhooks from ServiceM8
2. **API Client** - Ready to fetch data from ServiceM8 API
3. **Test Page** - UI to test the integration
4. **Logging** - All webhooks are logged for debugging

---

## 🔧 Step 1: Configure API Key

Add your ServiceM8 API key to `.env` file:

```env
SERVICEM8_API_KEY=smk-12d136-10e4c3ddbb74e060-51f57f05e2808b3f
SERVICEM8_BASE_URL=https://api.servicem8.com/api_1.0
SERVICEM8_WEBHOOK_SECRET=your-webhook-secret-here
```

**Note:** Get the webhook secret from ServiceM8 dashboard when setting up webhooks.

---

## 🧪 Step 2: Test API Connection

1. **Start your Laravel server:**
   ```bash
   php artisan serve --port=8001
   ```

2. **Visit the test page:**
   ```
   http://localhost:8001/servicem8/test-page
   ```

3. **Click "Test API Connection"** to verify your API key works

4. **Try fetching jobs and invoices** to see what data ServiceM8 returns

---

## 🔗 Step 3: Set Up Webhooks in ServiceM8

### Option A: Using ngrok (for local testing)

1. **Install ngrok:**
   - Download from: https://ngrok.com/download
   - Or: `choco install ngrok` (Windows)

2. **Start ngrok:**
   ```bash
   ngrok http 8001
   ```

3. **Copy the HTTPS URL** (e.g., `https://abc123.ngrok.io`)

4. **In ServiceM8 Dashboard:**
   - Go to Settings → Integrations → Webhooks
   - Add webhook URL: `https://abc123.ngrok.io/api/servicem8/webhook`
   - Select events you want to receive:
     - Job Created
     - Job Updated
     - Job Completed
     - Invoice Created
     - Invoice Updated
   - Save the webhook secret (add to `.env`)

### Option B: Using Production URL

1. **Deploy your Laravel app** to a server with HTTPS

2. **Use your production URL:**
   ```
   https://yourdomain.com/api/servicem8/webhook
   ```

3. **Configure in ServiceM8** same as above

---

## 📋 Step 4: Test Webhook

1. **Test webhook endpoint is accessible:**
   ```
   http://localhost:8001/api/servicem8/webhook/test
   ```
   Should return: `{"status":"ok","message":"ServiceM8 webhook endpoint is accessible"}`

2. **Trigger a test event in ServiceM8:**
   - Create a test job
   - Update a job status
   - Create a test invoice

3. **Check webhook logs:**
   - Laravel log: `storage/logs/laravel.log`
   - Webhook files: `storage/app/webhooks/servicem8-*.json`

---

## 📊 Step 5: View Test Results

Visit the test page to see:
- API connection status
- Sample data from ServiceM8
- Webhook logs
- API response examples

---

## 🔍 What Gets Logged

### Webhook Logs Include:
- All HTTP headers
- Request body
- Raw payload
- IP address
- Timestamp

### Storage Locations:
- **Laravel Log:** `storage/logs/laravel.log`
- **Webhook Files:** `storage/app/webhooks/servicem8-YYYY-MM-DD-HHMMSS.json`

---

## 🎯 Next Steps (After Testing)

Once webhooks are working:

1. **Create database tables** for:
   - Services/Jobs
   - Invoices
   - Customers
   - Sites

2. **Process webhook data** and store in database

3. **Update dashboard** to show real ServiceM8 data

4. **Sync documents** from ServiceM8

---

## 🐛 Troubleshooting

### API Connection Fails
- ✅ Check API key is correct in `.env`
- ✅ Verify API key is active in ServiceM8
- ✅ Check network/firewall settings

### Webhooks Not Received
- ✅ Verify webhook URL is accessible (use test endpoint)
- ✅ Check ServiceM8 webhook configuration
- ✅ Ensure HTTPS is used (ServiceM8 requires HTTPS)
- ✅ Check Laravel logs for errors

### CORS Issues
- ServiceM8 webhooks should work fine
- If testing from browser, check CORS settings

---

## 📚 ServiceM8 API Documentation

- **Developer Portal:** https://developer.servicem8.com/
- **REST API:** https://developer.servicem8.com/docs/rest-overview
- **Webhooks:** https://developer.servicem8.com/docs/webhooks-overview

---

## 🚀 Quick Start Commands

```bash
# 1. Add API key to .env
echo "SERVICEM8_API_KEY=smk-12d136-10e4c3ddbb74e060-51f57f05e2808b3f" >> .env

# 2. Start server
php artisan serve --port=8001

# 3. Start ngrok (in another terminal)
ngrok http 8001

# 4. Visit test page
# http://localhost:8001/servicem8/test-page
```

---

## ✅ Testing Checklist

- [ ] API key added to `.env`
- [ ] API connection test successful
- [ ] Can fetch jobs from ServiceM8
- [ ] Can fetch invoices from ServiceM8
- [ ] Webhook endpoint accessible
- [ ] ngrok/production URL configured
- [ ] Webhook configured in ServiceM8
- [ ] Test webhook received and logged

---

**Ready to test!** 🎉

Visit: `http://localhost:8001/servicem8/test-page`

