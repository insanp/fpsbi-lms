#!/bin/bash
# Exit immediately if a command exits with a non-zero status
set -e

echo "Switching to main branch..."
git checkout main
echo "Pushing main branch..."
git push origin main

echo "Switching to staging branch and merge with main..."
git checkout staging
git merge main
echo "Pushing staging branch..."
git push origin staging

echo "Switching to production branch and merge with staging..."
git checkout production
git merge staging
echo "Pushing production branch..."
git push origin production

echo "Switching back to main branch..."
git checkout main

echo "All pushes completed."