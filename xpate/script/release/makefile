PLUGIN_NAME := xpate-payment-plugin
GITHUB_REPO := Max-Prokofiev-leasoft/GPEv2test2
TAG := v0.9.0
ZIP_FILENAME := ../../plugin/$(PLUGIN_NAME).zip
RELEASE_NAME := release PRIVAT  $(TAG)

release:
	@echo "Creating GitHub release for $(GITHUB_REPO)..."
	gh release create $(TAG) "$(ZIP_FILENAME)" -n "$(RELEASE_NAME)" -R $(GITHUB_REPO)
	@echo "GitHub release created for $(TAG) in repository $(GITHUB_REPO)"

.PHONY: release
