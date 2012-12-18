# Upgrade newsletter data from 0.5 to 1.0, see CHANGELOG for details.
# Please back up your data before performing this operation.
# Script only tested on MySQL.

SET sql_mode = 'ANSI';

UPDATE "Newsletter" 
	SET "Status" = 'Sent' 
	WHERE "Status" = '' OR "Status" = 'Send';

UPDATE "Newsletter", "NewsletterType"
	SET 
		"Newsletter"."SendFrom" = "NewsletterType"."FromEmail",
		"Newsletter"."RenderTemplate" = "NewsletterType"."Template"
	WHERE 
		"Newsletter"."ParentID" = "NewsletterType"."ID";

INSERT INTO "MailingList" ("ID", "Title", "Created", "LastEdited")
	SELECT
		"Group"."ID", "Group"."Title", "Group"."Created", "Group"."LastEdited"
		FROM "Group"
		LEFT JOIN "NewsletterType" ON "NewsletterType"."GroupID" = "Group"."ID"
		WHERE "NewsletterType"."GroupID" IS NOT NULL;

INSERT INTO "Newsletter_MailingLists" ("NewsletterID", "MailingListID")
	SELECT 
		-- Assumes Group.ID == MailingList.ID
		"Newsletter"."ID", "NewsletterType"."GroupID" 
		FROM "NewsletterType"
		LEFT JOIN "Newsletter" ON "Newsletter"."ParentID" = "NewsletterType"."ID";

INSERT INTO "Recipient" ("ID", "Created", "LastEdited", "Email", "FirstName", "Surname", "BouncedCount", "Blacklisted")
	SELECT
		"Member"."ID", "Member"."Created", "Member"."LastEdited", "Member"."Email", "Member"."FirstName", "Member"."Surname", "Member"."Bounced", "Member"."BlacklistedEmail"
		FROM "Member"
		LEFT JOIN "Group_Members" ON "Member"."ID" = "Group_Members"."MemberID"
		LEFT JOIN "Group" ON "Group"."ID" = "Group_Members"."GroupID"
		LEFT JOIN "NewsletterType" ON "NewsletterType"."GroupID" = "Group"."ID"
		WHERE "NewsletterType"."GroupID" IS NOT NULL
		GROUP BY "Member"."ID";


INSERT INTO "MailingList_Recipients" ("MailingListID", "RecipientID")
	SELECT 
		-- Assumes Group.ID == MailingList.ID and Recipient.ID == Member.ID
		"Group"."ID", "Member"."ID"
		FROM "Member"
		LEFT JOIN "Group_Members" ON "Member"."ID" = "Group_Members"."MemberID"
		LEFT JOIN "Group" ON "Group"."ID" = "Group_Members"."GroupID"
		LEFT JOIN "NewsletterType" ON "NewsletterType"."GroupID" = "Group"."ID"
		WHERE "NewsletterType"."GroupID" IS NOT NULL;

INSERT INTO "SendRecipientQueue" ("Status", "NewsletterID", "RecipientID")
	SELECT 
		"Result", "ParentID", "MemberID"
		FROM "Newsletter_SentRecipient";

UPDATE "UnsubscribeRecord", "Group", "NewsletterType"
	SET 
		"UnsubscribeRecord"."MailingListID" = "Group"."ID",
		"UnsubscribeRecord"."RecipientID" = "UnsubscribeRecord"."MemberID"
	WHERE 
		"NewsletterType"."GroupID" = "Group"."ID"
		AND "UnsubscribeRecord"."NewsletterTypeID" = "NewsletterType"."ID";

DROP TABLE "NewsletterType";
DROP TABLE "Newsletter_SentRecipient";
DROP TABLE "Newsletter_Recipient";
DROP TABLE "NewsletterEmailBlacklist";
ALTER TABLE "Newsletter" DROP "ParentID";
ALTER TABLE "UnsubscribeRecord" DROP "NewsletterTypeID";
ALTER TABLE "UnsubscribeRecord" DROP "MemberID";