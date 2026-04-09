# API Routes (`/api/v1`)

## Auth
- `POST /auth/register`
- `POST /auth/login`
- `POST /auth/forgot-password`
- `POST /auth/reset-password`
- `POST /auth/logout`

## Users / RBAC
- `GET /users`
- `POST /users`
- `GET /users/{id}`
- `PUT /users/{id}`
- `DELETE /users/{id}`
- `GET /roles`
- `POST /roles`
- `POST /roles/{roleId}/permissions`
- `POST /users/{userId}/roles`

## Projects
- `GET /projects`
- `POST /projects`
- `GET /projects/{id}`
- `PUT /projects/{id}`
- `DELETE /projects/{id}`
- `POST /projects/{id}/team`

## Documents
- `GET /documents`
- `POST /documents/upload`
- `GET /documents/{id}`
- `PUT /documents/{id}`
- `GET /documents/{id}/versions`
- `POST /documents/{id}/versions`
- `GET /documents/{id}/download`
- `GET /documents/search`

## Workflow & Approvals
- `GET /workflows`
- `POST /workflows`
- `POST /workflows/{id}/steps`
- `POST /approvals/{id}/approve`
- `POST /approvals/{id}/reject`
- `POST /approvals/{id}/comment`
- `GET /documents/{id}/approval-history`

## Transmittals
- `GET /transmittals`
- `POST /transmittals`
- `GET /transmittals/{id}`
- `PUT /transmittals/{id}`
- `POST /transmittals/{id}/documents`

## Dashboard & Reports
- `GET /dashboard/summary`
- `GET /dashboard/pending-approvals`
- `GET /dashboard/recent-documents`
- `GET /reports/document-status`
- `GET /reports/approval-delays`
- `GET /reports/project-progress`
- `GET /reports/export/{type}` (`pdf` or `xlsx`)
