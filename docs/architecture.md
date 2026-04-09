# E-DMS Architecture

## Core Principles

- SOLID + service-based modular MVC
- Clean Architecture layering by module:
  - Domain: entities/rules
  - Application: use-cases/services
  - Interface: controllers/requests/resources
  - Infrastructure: persistence/storage/integrations

## Module Boundaries

- Auth & RBAC
- Projects
- Documents
- Workflow
- Transmittals
- Dashboard
- Reports
- Shared (audit, notifications, helpers)

## Key Design Decisions

- API-first (`/api/v1`) with token auth (Sanctum in runtime setup)
- All critical actions emit audit records
- Document binaries decoupled from metadata for storage flexibility
- Approval workflow modeled as ordered steps with immutable history
- Reports generated async-ready and exportable as file artifacts

## Scalability

- Queue-backed notifications/report generation
- S3-compatible storage with signed URLs
- Redis cache for dashboard widgets
- Prepared for OCR and e-sign microservice integration

## Security

- Role + permission checks at controller/service layers
- Encrypted at-rest document key metadata
- Signed temporary URLs for downloads
- Full audit trail (who/what/when/from where)
